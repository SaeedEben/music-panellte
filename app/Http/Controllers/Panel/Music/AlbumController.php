<?php

namespace App\Http\Controllers\Panel\Music;

use App\Http\Controllers\Controller;
use App\Http\Requests\Music\Album\StoreAlbumRequest;
use App\Http\Requests\Music\Album\UpdateAlbumRequest;
use App\Http\Resources\Music\Album\AlbumIndexResource;
use App\Http\Resources\Music\Album\AlbumShowResource;
use App\Models\Music\Album;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response |object
     */
    public function index()
    {
        $album = Album::paginate();

        return AlbumIndexResource::collection($album);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAlbumRequest $request
     *
     * @return Response|array
     */
    public function store(StoreAlbumRequest $request)
    {
        \DB::beginTransaction();
        try {
            $album = new Album();

            $translations = [
                'fa' => $request->name['fa'],
                'en' => $request->name['en'],
            ];

            $album->setTranslations('name', $translations);
            $album->fill($request->all());
            $album->save();

            \DB::commit();

            return [
                'success' => true,
                'message' => trans('responses.panel.music.message.store'),
            ];

        }catch(\Exception $exception){
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
     * @param Album $album
     *
     * @return Response|object
     */
    public function show(Album $album)
    {
        return new AlbumShowResource($album);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAlbumRequest $request
     * @param Album              $album
     *
     * @return array
     */
    public function update(UpdateAlbumRequest $request, Album $album)
    {
        \DB::beginTransaction();
        try {
            $translations = [
                'fa' => $request->name['fa'],
                'en' => $request->name['en'],
            ];

            $album->setTranslations('name', $translations);
            $album->fill($request->all());
            $album->save();

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
     * @param Album $album
     *
     * @return Response|array
     * @throws \Exception
     */
    public function destroy(Album $album)
    {
        try {
            $album->delete();

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
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return Response|array
     */
    public function restore($id)
    {

        try {
            Album::onlyTrashed()->findOrFail($id)->restore();

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

    /**
     * Remove the specified resource from storage.
     *
     * @return Response|array
     */
    public function list(){
        return Album::select('id','name')->get();
    }

}
