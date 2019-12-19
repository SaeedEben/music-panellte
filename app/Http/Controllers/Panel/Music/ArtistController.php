<?php

namespace App\Http\Controllers\Panel\Music;
use App\Http\Controllers\Controller;
use App\Http\Requests\Music\Category\StoreCategoryRequest;
use App\Http\Resources\Music\Artist\ArtistIndexResource;
use App\Http\Resources\Music\Artist\ArtistShowResource;
use App\Models\Music\Artist;
use Illuminate\Http\Request;

/**
 * Class ArtistController
 *
 * @package App\Http\Controllers\Panel\Music
 *
 *
 */
class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|object
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function index()
    {
//        cache()->remember('artists', now()->addSeconds(5), function (){
//            $artist = Artist::paginate();
//
//            return ArtistIndexResource::collection($artist);
//        });

        if (cache()->has('artists')){
            return cache()->pull('artists');
        }
        $artist = Artist::paginate();

        cache()->put('artists', $artist , now()->addSeconds(2));

        return ArtistIndexResource::collection($artist);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response|array
     */
    public function store(StoreCategoryRequest $request)
    {

//       $locale =  $request->headers->get('accept_language');
//        app()->setLocale($locale);
        \DB::beginTransaction();

        try {
            $artist = new Artist();

            $translations = [
                'en' => $request->name['en'],
                'fa' => $request->name['fa'],
            ];

            $artist->setTranslations('name', $translations);

            $artist->fill($request->all());
            $artist->save();

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
     * @param Artist $artist
     *
     * @return void|object
     */
    public function show(Artist $artist)
    {
        return new ArtistShowResource($artist);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Artist                   $artist
     *
     * @return \Illuminate\Http\Response|array
     */
    public function update(Request $request, Artist $artist)
    {
        \DB::beginTransaction();

        try {
            $translations = [
                'name_en' => $request->name['en'],
                'name_fa' => $request->name['fa'],
            ];

            $artist->setTranslations('name' , $translations);

            $artist->fill($request->all());
            $artist->save();

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
     * @param Artist $artist
     *
     * @return void|array
     * @throws \Exception
     */
    public function destroy(Artist $artist)
    {
        try {
            $artist->delete();

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
     * @return void|array
     * @throws \Exception
     */
    public function restore($id)
    {
        try {
            Artist::onlyTrashed()->findOrFail($id)->restore();

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
        return Artist::select('id' , 'name')->get();
    }
}
