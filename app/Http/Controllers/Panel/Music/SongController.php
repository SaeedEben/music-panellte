<?php

namespace App\Http\Controllers\Panel\Music;

use App\Http\Controllers\Controller;
use App\Http\Resources\Music\Song\SongIndexResource;
use App\Http\Resources\Music\Song\SongShowResource;
use App\Models\Music\Album;use App\Models\Music\Artist;use App\Models\Music\Category;use App\Models\Music\Genre;use App\Models\Music\ImageFile;use App\Models\Music\Photo;use App\Models\Music\Song;
use Illuminate\Contracts\View\Factory;use Illuminate\Http\RedirectResponse;use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;use Illuminate\Routing\Redirector;use Illuminate\View\View;use phpDocumentor\Reflection\File;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $pure_data = Song::paginate();
        $obj = SongIndexResource::collection($pure_data)->resource;
        $songs = json_decode(json_encode($obj))->data;
        return view('/song/index' , compact('songs'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Redirector|array
     */
    public function store(Request $request)
    {
        \DB::beginTransaction();

        try {
            $song         = new Song();
            $translations = [
                'en' => $request->name['en'],
                'fa' => $request->name['fa'],
            ];
            $song->setTranslations('name', $translations);
            $song->fill($request->all());

            // ------------------- assign category ------------------------

            $catid = explode('.' , $request->category);
            $song->category_id = $catid[0];

            // ------------------- assign album ------------------------

            $albid = explode('.' , $request->album);
            $song->album_id    = $albid[0];


            $song->save();

            // ------------------- attaching file ------------------------

            $esm = $request->file('songname')->getClientOriginalName();
            $storage = storage_path("app/public/music/{$esm}");
            $request->file('songname')->move('storage/musics' , $esm);

            $photo = new Photo();
            $photo->image_path = $storage;
            $photo->save();

            $song->photos()->attach($photo->id);


            // ------------------- attaching genre ------------------------

            $genid = explode('.' , $request->genre);
            $song->genres()->attach($genid[0]);

            // ------------------- attaching artist ------------------------

            $artid = explode('.' , $request->artist);
            $song->artists()->attach($artid[0]);


            \DB::commit();
            return redirect('music/song');

        }catch (\Exception $exception){
            \DB::rollBack();

            return [
                'success' => false,
                'message' => $exception->getMessage(),
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Song $song
     *
     * @return Factory|View
     */
    public function show(Song $song)
    {
        $pure_data = new SongShowResource($song->load('photos' , 'artists' , 'category' , 'genres' , 'album'));
        $song = json_decode(json_encode($pure_data->resource));
        // ------------------- image path ------------------------

        $path = explode('/' , $song->photos[0]->image_path);
        $path = end($path);
        $storage = 'storage/musics/'.$path;
        // ------------------- Relations ------------------------
        $category = $song->category;
        $genres = $song->genres;
        $artists = $song->artists;
        $album = $song->album;


        $song = json_decode(json_encode($song) , true);
        return view('song.show',compact('song' , 'storage' , 'category' , 'genres' , 'album' , 'artists'));
    }


    public function edit(Song $song)
    {
        $obj = new SongIndexResource(($song));
        $song = json_decode(json_encode($obj),true);
        return view('song.update' , compact('song'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Song    $song
     *
     * @return RedirectResponse|Redirector|array
     */
    public function update(Request $request, Song $song)
    {
        \DB::beginTransaction();

        try {
            $translation = [
                'fa' => $request->name['fa'],
                'en' => $request->name['en'],
            ];
            $song->setTranslations('name', $translation);
            $song->fill($request->all());
            $song->save();

            \DB::commit();
            return redirect('music/song');
        }catch (\Exception $exception){
            \DB::rollBack();

            return [
                'success' => false,
                'message' => $exception->getMessage(),
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Song $song
     *
     * @return RedirectResponse|array
     * @throws \Exception
     */
    public function destroy(Song $song)
    {
        try {
            $song->delete();

            return redirect()->back();
        }catch (\Exception $exception){

            return [
                'success' => false,
                'message' => $exception->getMessage(),
            ];
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse|array
     */
    public function restore(Request $request)
    {
        try {
            Song::onlyTrashed()->findOrFail($request->id)->restore();

            return redirect()->back();
        }catch (\Exception $exception){

            return [
                'success' => false,
                'message' => $exception->getMessage(),
            ];
        }
    }

    public function list()
    {
        return Song::select('id' , 'name')->get();
    }

    /**
     * Display the specified resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $genre = Genre::all();
        $category = Category::all();
        $album = Album::all();
        $artist = Artist::all();
        return view('song.create' , compact('genre' , 'category' , 'album' , 'artist'));
    }
}
