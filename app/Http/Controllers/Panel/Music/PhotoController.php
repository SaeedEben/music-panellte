<?php

namespace App\Http\Controllers\Panel\Music;

use App\Http\Controllers\Controller;
use App\Models\Music\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function show()
    {
        // ------------------- Song Image ------------------------

        $song_photo = \DB::table('photo_song')->pluck('photo_id')->toArray();

        foreach ($song_photo as $photo) {
            $image  = Photo::where('id', $photo)->get('image_path');
            $sort   = json_decode(json_encode($image), true);
            $image  = explode('/', $sort[0]['image_path']);
            $path   = end($image);
            $song[] = "/storage/musics/" . $path;
        }


        // ------------------- Artist Image ------------------------

        $artist_photo = \DB::table('artist_photo')->pluck('photo_id')->toArray();

        foreach ($artist_photo as $photo) {
            $image    = Photo::where('id', $photo)->get('image_path');
            $sort     = json_decode(json_encode($image), true);
            $image    = explode('/', $sort[0]['image_path']);
            $path     = end($image);
            $artist[] = "/storage/musics/" . $path;
        }

        // ------------------- Album Image ------------------------

        $album_photo = \DB::table('album_photo')->pluck('photo_id')->toArray();

        foreach ($album_photo as $photo) {
            $image   = Photo::where('id', $photo)->get('image_path');
            $sort    = json_decode(json_encode($image), true);
            $image   = explode('/', $sort[0]['image_path']);
            $path    = end($image);
            $album[] = "/storage/musics/" . $path;
        }

        return view('photo.index', compact('song', 'artist', 'album'));

    }
}
