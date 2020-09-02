<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Account
 *
 * @property int $id
 * @property int $website_id
 * @property string $email
 * @property int $recieved
 * @property int $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Website[] $websites
 * @property-read int|null $websites_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereRecieved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereWebsiteId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Submission[] $submissions
 * @property-read int|null $submissions_count
 * @property string|null $remember_token
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereRememberToken($value)
 */
class Account extends Model
{
    protected $fillable = ['email', 'recieved', 'type', 'website_id'];

    public function websites()
    {
        return $this->hasMany(Website::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
