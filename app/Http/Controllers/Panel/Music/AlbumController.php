<?php

namespace App\Http\Controllers\Panel\Music;

use App\Http\Controllers\Controller;
use App\Http\Requests\Music\Album\StoreAlbumRequest;
use App\Http\Requests\Music\Album\UpdateAlbumRequest;
use App\Http\Resources\Music\Album\AlbumIndexResource;
use App\Http\Resources\Music\Album\AlbumShowResource;
use App\Models\Music\Album;
use Illuminate\Http\RedirectResponse;use Illuminate\Http\Request;
use Illuminate\Http\Response;use Illuminate\Routing\Redirector;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response |object
     */
    public function index()
    {
        $pure_data = Album::paginate();
        $obj = AlbumIndexResource::collection($pure_data)->resource;
        $albums = json_decode(json_encode($obj))->data;
        return view('album/index' , compact('albums'));
    }


    public function edit(Album $album)
    {
        $obj = new AlbumIndexResource($album);
        $album = json_decode(json_encode($obj),true);
        return view('album.update' , compact('album'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAlbumRequest $request
     *
     * @return RedirectResponse|Redirector|array
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

            return redirect('music/album');

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
     * @return RedirectResponse|Redirector|array
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

            return redirect('music/album');
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
     * @return RedirectResponse|Redirector|array
     * @throws \Exception
     */
    public function destroy(Album $album)
    {
        try {
            $album->delete();

            return redirect('music/album');
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
     * @return RedirectResponse|Redirector|array
     */
    public function restore(Request $request)
    {

        try {
            Album::onlyTrashed()->findOrFail($request->id)->restore();

            return redirect('music/album');

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
