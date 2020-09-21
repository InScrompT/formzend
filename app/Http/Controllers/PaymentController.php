<?php

namespace App\Http\Controllers;

use App\Plan;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
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
}
