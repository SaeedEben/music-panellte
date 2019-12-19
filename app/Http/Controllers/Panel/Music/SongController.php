<?php

namespace App\Http\Controllers\Panel\Music;

use App\Http\Controllers\Controller;
use App\Http\Resources\Music\Song\SongIndexResource;
use App\Http\Resources\Music\Song\SongShowResource;
use App\Models\Music\Song;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $song = Song::paginate();

        return SongIndexResource::collection($song);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return array
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
            $song->category_id = $request->category_id;
            $song->album_id    = $request->album_id;
            $song->save();

            \DB::commit();
            return [
                'success' => true,
                'message' => trans('responses.panel.music.message.store'),
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
}
