<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Submission
 *
 * @property int $id
 * @property int $form_id
 * @property string $data
 * @property string $files
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Form|null $form
 * @method static \Illuminate\Database\Eloquent\Builder|Submission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Submission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Submission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Submission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submission whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submission whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submission whereFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submission whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Submission extends Model
{
    use HasFactory;

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
