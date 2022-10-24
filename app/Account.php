<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['email', 'recieved', 'type', 'website_id', 'allowed'];

    public function websites()
    {
        return $this->hasMany(Website::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
