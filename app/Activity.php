<?php

namespace App;

use App\Enums\ActivityType;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Activity
 *
 * @property int $id
 * @property int $account_id
 * @property int|null $website_id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Account $account
 * @property-read \App\Website|null $website
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereWebsiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity isDayOld($days = 1)
 * @mixin \Eloquent
 */
class Activity extends Model
{
    protected $casts = [
        'type' => ActivityType::class,
    ];

    protected $fillable = [
        'account_id', 'website_id', 'type', 'login_key'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    /**
     * Scope a query to only N days old entries.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param integer $days
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsDayOld($query, $days = 1)
    {
        return $query->where(self::CREATED_AT, '>=', now()->subDays($days));
    }
}
