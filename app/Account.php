<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Account
 *
 * @property int $id
 * @property int $website_id
 * @property string $email
 * @property int $recieved
 * @property int $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Website[] $websites
 * @property-read int|null $websites_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereRecieved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereWebsiteId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Submission[] $submissions
 * @property-read int|null $submissions_count
 * @property string|null $remember_token
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereRememberToken($value)
 * @property int $allowed
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \App\Plan $plan
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereAllowed($value)
 * @property int $plan_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account wherePlanId($value)
 * @property string|null $customer_id
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCustomerId($value)
 */
class Account extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['email', 'recieved', 'type', 'website_id', 'allowed'];

    public function websites()
    {
        return $this->hasMany(Website::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
