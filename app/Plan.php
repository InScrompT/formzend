<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $casts = [
        'amount' => 'int',
        'quantity' => 'int',
        'available' => 'boolean',
        'is_subscription' => 'boolean',
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
