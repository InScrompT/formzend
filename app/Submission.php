<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
