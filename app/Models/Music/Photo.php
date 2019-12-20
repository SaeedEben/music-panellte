<?php

namespace App\Models\Music;

use Illuminate\Database\Eloquent\Model;

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
