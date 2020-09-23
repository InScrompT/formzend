<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Plan
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Account[] $accounts
 * @property-read int|null $accounts_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property int $amount
 * @property int $quantity
 * @property int $available
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereUpdatedAt($value)
 * @property int $is_subscription
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereIsSubscription($value)
 */
class Plan extends Model
{
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
