<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

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
