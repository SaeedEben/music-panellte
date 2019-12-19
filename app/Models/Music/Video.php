<?php

namespace App\Models\Music;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Video
 *
 * @package App\Models\Music
 *
 * @property int    $id
 *
 * @property string $name
 * @property Carbon $release_at
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Song   $song
 */
class Video extends Model
{
    protected $fillable = [
        'name',
        'duration',
        'release_at',
    ];

    protected $casts = [
        'duration' => 'date:hh:mm',
    ];

    // <<<<<<<<<<<<<<<<<<< Relations >>>>>>>>>>>>>>>>>>>>>>>
    public function song()
    {
        return $this->belongsTo(Song::class);
    }

    // <<<<<<<<<<<<<<<<<<< Polymorph Relations >>>>>>>>>>>>>>>>>>>>>>>


    public function comments()
    {
        return $this->morphMany(Comment::class , 'commentable');
    }

    public function likes()
    {
        return $this->morphMany(Like::class , 'likable');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

}
