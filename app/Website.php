<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Website extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'verified', 'account_id'];

    protected $casts = [
        'account_id' => 'int'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
