<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $casts = [
        'account_id' => 'int',
        'data' => 'collection',
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
