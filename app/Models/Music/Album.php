<?php

namespace App\Models\Music;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

/**
 * Class Album
 *
 * @package App\Models\Music
 *
 * @property int    $id
 *
 * @property object $name
 * @property Carbon $release_at
 * @property int    $number_of_track
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Album extends Model
{
    protected $fillable = ['name', 'release_at', 'number_of_track'];

    // ------------------- Translation ------------------------
    use HasTranslations, SoftDeletes;

    public $translatable = ['name'];

    // ------------------- Relations ------------------------


    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

}
