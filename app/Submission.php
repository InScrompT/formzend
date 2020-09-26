<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Submission
 *
 * @property int $id
 * @property int $website_id
 * @property int $account_id
 * @property \Illuminate\Database\Eloquent\Collection $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Account $account
 * @property-read \App\Website $website
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Submission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Submission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Submission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Submission whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Submission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Submission whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Submission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Submission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Submission whereWebsiteId($value)
 * @mixin \Eloquent
 */
class Submission extends Model
{
    protected $casts = [
        'data' => 'collection'
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
