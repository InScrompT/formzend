<?php

namespace App\Http\Controllers;

use App\Plan;
use App\Order;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
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

        $order->account_id = session('id');
        $order->plan_id = $plan->id;
        $order->code = Str::uuid();

        $razorpay = resolve(Api::class)->order->create([
            'receipt' => $order->code,
            'amount' => intval((intval(Str::replaceFirst('$', '', $plan->amount)) * 73.6) * 100),
            'currency' => 'INR',
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
        try {
            resolve(Api::class)->utility->verifyPaymentSignature(request()->all());

            $order = Order::whereRazorpayOrderId(request('razorpay_order_id'))->firstOrFail();

            $order->razorpay_payment_id = request('razorpay_payment_id');
            $order->completed = true;

            $order->account->plan_id = $order->plan_id;
            $order->account->allowed = $order->account->allowed + $order->plan->quantity;

            $order->saveOrFail();
            $order->account->saveOrFail();

            /**
             * TODO: After payment done chores
             * - send them an email / invoice
             */
            \Session::flash('success', 'Payment processed. Your account has now been upgraded!');
            return redirect(route('dashboard'));
        } catch (SignatureVerificationError $e) {
            \Session::flash('error', 'Something happened. Payment did not process!');
            return redirect(route('dashboard'));
        }
    }

    public function paymentCancelled()
    {
        \Session::flash('info', 'The payment was cancelled');
        return redirect(route('dashboard'));
    }
}
