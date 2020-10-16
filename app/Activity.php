<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    private static $EMAIL_VERIFICATION_SENT = 0;

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
