<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
