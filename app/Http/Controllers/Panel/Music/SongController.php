<?php

namespace App\Http\Controllers\Panel\Music;

use App\Http\Controllers\Controller;
use App\Http\Resources\Music\Song\SongIndexResource;
use App\Http\Resources\Music\Song\SongShowResource;
use App\Models\Music\Album;use App\Models\Music\Artist;use App\Models\Music\Category;use App\Models\Music\Genre;use App\Models\Music\ImageFile;use App\Models\Music\Song;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;use phpDocumentor\Reflection\File;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|array
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

            $file = new ImageFile();
            $file->image_path = $storage;
            $file->save();

            $song->files()->attach($file->id);


            // ------------------- attaching genre ------------------------

            $genid = explode('.' , $request->genre);
            $song->genres()->attach($genid[0]);

            // ------------------- attaching artist ------------------------

            $artid = explode('.' , $request->artist);
            $song->genres()->attach($artid[0]);


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
     * @return SongShowResource
     */
    public function show(Song $song)
    {
        return new SongShowResource($song);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Song    $song
     *
     * @return array
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
            return [
                'success' => true,
                'message' => trans('responses.panel.music.message.update'),
            ];
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
     * @return array
     * @throws \Exception
     */
    public function destroy(Song $song)
    {
        try {
            $song->delete();

            return [
                'success' => true,
                'message' => trans('responses.panel.music.message.delete'),
            ];
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
     * @param $id
     *
     * @return array
     * @throws \Exception
     */
    public function restore($id)
    {
        try {
            Song::onlyTrashed()->findOrFail($id)->restore();

            return [
                'success' => true,
                'message' => trans('responses.panel.music.message.restore'),
            ];
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
