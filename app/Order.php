<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
