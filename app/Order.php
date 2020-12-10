<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Order
 *
 * @property-read \App\Account $account
 * @property-read \App\Plan $plan
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $plan_id
 * @property int $account_id
 * @property string $razorpay_order_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereRazorpayOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUpdatedAt($value)
 * @property string $code
 * @property int $completed
 * @property string|null $razorpay_payment_id
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRazorpayPaymentId($value)
 * @property int|null $amount
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAmount($value)
 */
class Order extends Model
{
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
