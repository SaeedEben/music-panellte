<?php

namespace App\Models\Music;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;


/**
 * Class Genre
 *
 * @package App\Models\Music
 *
 * @property int    $id
 *
 * @property string $name
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Song[] $song
 */
class Genre extends Model
{
    protected $fillable = ['name'];

    // ------------------- Translation ------------------------
    use HasTranslations, softDeletes;

    public $translatable = ['name'];

    // ------------------- Relations ------------------------

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'song_genre', 'genre_id', 'song_id');
    }

}
