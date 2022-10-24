<?php

namespace App;

use App\Enums\ActivityType;
use Illuminate\Database\Eloquent\Model;

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
