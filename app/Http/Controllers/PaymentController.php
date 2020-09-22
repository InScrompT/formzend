<?php

namespace App\Http\Controllers;

use App\Plan;
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
        /**
         * TODO: Implement database stuff
         * - Create an order, with completed set to false
         * - Get the id and pass it to razorpay
         */
        $receipt = Str::uuid();
        $razorpay = resolve(Api::class)->order->create([
            'receipt' => $receipt,
            'amount' => intval((intval(Str::replaceFirst('$', '', $plan->amount)) * 73.6) * 100),
            'currency' => 'INR',
            'notes' => [
                'email' => session('email')
            ]
        ]);

        return view('plans.redirect')->with([
            'key' => $receipt,
            'order' => $razorpay->id
        ]);
    }

    public function paymentCallback()
    {
        try {
            resolve(Api::class)->utility->verifyPaymentSignature(request()->all());

            /**
             * TODO: Implement database stuff (payment done)
             * - find user
             * - update their limits
             * - show them a success message
             * - send them an email / invoice
             */
            return ['payment' => 'DONE'];
        } catch (SignatureVerificationError $e) {
            // TODO: Implement error page
            return ['payment' => 'rigged, but I am brilliant'];
        }
    }

    public function paymentCancelled()
    {
        // TODO: Implement cancelled page
        return [
            'cancelled'
        ];
    }
}
