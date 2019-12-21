<?php

namespace App\Models\Music;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Photo
 *
 * @package App\Models\Music
 *
 * @property int    $id
 *
 * @property string $image_path
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class Photo extends Model
{
    protected $fillable = ['image_path'];

    // ------------------- Relations ------------------------

    public function songs()
    {
        return $this->belongsToMany(Song::class);
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }

    public function albums()
    {
        return $this->belongsTo(Album::class);
    }
}
