<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Website
 *
 * @property int $id
 * @property int $account_id
 * @property string $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Account $account
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Website newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Website newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Website query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Website whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Website whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Website whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Website whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Website whereUrl($value)
 * @mixin \Eloquent
 * @property int $verified
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Website whereVerified($value)
 */
class Website extends Model
{
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
