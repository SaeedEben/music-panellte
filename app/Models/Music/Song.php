<?php

namespace App\Models\Music;

use App\Models\Feature\Favorite;
use App\Models\Feature\History;
use App\Models\Feature\Playlist;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;


/**
 * Class Song
 *
 * @package App\Models\Music
 *
 * @property int       $id
 *
 * @property \DateTime $release_at
 * @property Carbon    $duration
 * @property string    $lyric
 *
 * @property string    $image_path
 *
 * @property Carbon    $created_at
 * @property Carbon    $updated_at
 *
 * @property Genre[]   $genre
 * @property Category  $category
 * @property int       $category_id
 * @property int       $album_id
 */
class Song extends Model
{
    protected $fillable = [
        'name',
        'release_at',
        'duration',
        'lyric',

    ];

    // ------------------- Translator ------------------------
    use HasTranslations, softDeletes;

    public $translatable = ['name'];


    // ------------------- Relations ------------------------


    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'song_genre', 'song_id', 'genre_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function video()
    {
        return $this->hasOne(Video::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    // ------------------- Polymorphic Relations ------------------------


    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
