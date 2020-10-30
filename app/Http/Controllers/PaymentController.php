<?php

namespace App\Http\Controllers;

use App\Plan;
use App\Order;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use App\Events\PaymentProcessed;
use Razorpay\Api\Errors\SignatureVerificationError;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('buyPlan');
    }

    public function showPlans()
    {
        $plans = Plan::all();

        $normalPlan = $plans->reject(function ($plan) {
            return $plan->is_subscription;
        })->all();
        $subscriptionPlans = $plans->reject(function ($plan) {
            return !$plan->is_subscription;
        })->all();

        return view('plans.index')->with([
            'normalPlan' => $normalPlan,
            'subscriptionPlan' => $subscriptionPlans,
        ]);
    }

    public function buyPlan(Plan $plan)
    {
        $order = new Order();

        $order->account_id = auth()->id();
        $order->plan_id = $plan->id;
        $order->code = Str::uuid();

        $razorpay = resolve(Api::class)->order->create([
            'receipt' => $order->code,
            'amount' => intval($plan->amount * 100),
            'currency' => 'USD',
            'notes' => [
                'email' => session('email')
            ]
        ]);

        $order->razorpay_order_id = $razorpay->id;
        $order->saveOrFail();

        return view('plans.redirect')->with([
            'order' => $razorpay->id
        ]);
    }

    public function paymentCallback()
    {
        $errorMeta = request()->exists('error')
            ? json_decode(request('error.metadata')) : null;
        $razorpayOrderID = request('razorpay_order_id') ?? $errorMeta->order_id;

        try {
            $order = Order::whereRazorpayOrderId($razorpayOrderID)->firstOrFail();

            // Fixes the bug where user is automatically logged out.
            // reason TBD.
            \Auth::login($order->account);

            if (request()->exists('error')) {
                session()->flash('error', 'Payment was rejected. Please try again!');
                return redirect()->route('dashboard');
            }

            resolve(Api::class)->utility->verifyPaymentSignature(request()->all());

            $order->load(['account', 'plan']);

            $order->razorpay_payment_id = request('razorpay_payment_id');
            $order->completed = true;

            $order->account->plan_id = $order->plan_id;
            $order->account->allowed = $order->account->allowed + $order->plan->quantity;

            $order->saveOrFail();
            $order->account->saveOrFail();

            $order->refresh();

            event(new PaymentProcessed($order));

            session()->flash('success', 'Payment processed. Your account has now been upgraded!');
            return redirect()->route('dashboard');
        } catch (SignatureVerificationError $e) {
            session()->flash('error', 'Something happened. Payment did not process!');
            return redirect()->route('dashboard');
        }
    }

    public function paymentCancelled()
    {
        session()->flash('info', 'The payment was cancelled');
        return redirect()->route('dashboard');
    }
}
