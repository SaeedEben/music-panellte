<?php

namespace App\Http\Controllers\Panel\Music;
use App\Http\Controllers\Controller;
use App\Http\Requests\Music\Category\StoreCategoryRequest;
use App\Http\Resources\Music\Artist\ArtistIndexResource;
use App\Http\Resources\Music\Artist\ArtistShowResource;
use App\Models\Music\Artist;
use App\Models\Music\Photo;use Illuminate\Http\RedirectResponse;use Illuminate\Http\Request;use Illuminate\Routing\Redirector;

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
        $pure_data = Artist::paginate();
        $obj = ArtistIndexResource::collection($pure_data)->resource;
        $artists = json_decode(json_encode($obj))->data;
        return view('artist.index' , compact('artists'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return RedirectResponse|Redirector|array
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

            // ------------------- attaching file image ------------------------

            $esm = $request->file('image')->getClientOriginalName();
            $storage = storage_path("app/public/music/{$esm}");
            $request->file('image')->move('storage/musics' , $esm);

            $photo = new Photo();
            $photo->image_path = $storage;
            $photo->save();

            $artist->photos()->attach($photo->id);

            \DB::commit();
            return redirect('music/artist');
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
        $pure_data = new ArtistShowResource($artist->load('photos'));
        $artist = json_decode(json_encode($pure_data->resource));

        $path = explode('/' , $artist->photos[0]->image_path);
        $path = end($path);
        $storage = 'storage/musics/'.$path;

        $artist = json_decode(json_encode($artist) , true);
        return view('artist.show' , compact('artist' , 'storage'));
    }


    public function edit(Artist $artist)
    {
        $pure_data = new ArtistShowResource($artist->load('photos'));
        $art = json_decode(json_encode($pure_data->resource));

        $path = explode('/' , $art->photos[0]->image_path);
        $path = end($path);
        $storage = 'storage/musics/'.$path;


        $obj = new ArtistIndexResource($artist);
        $artist = json_decode(json_encode($obj),true);
        return view('artist.update' , compact('artist' , 'storage'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Artist                   $artist
     *
     * @return RedirectResponse|Redirector|array
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

            // ------------------- change image ------------------------

            if ($request->image){
                $image = $artist->load('photos');
                $image = json_decode(json_encode($image->photos),true);
                $artist->photos()->detach($image[0]['id']);


                $e = $request->file('image')->getClientOriginalName();
                $storage = storage_path("app/public/music/{$e}");
                $request->file('image')->move('storage/musics' , $e);

                $photo = new Photo();
                $photo->image_path = $storage;
                $photo->save();

                $artist->photos()->attach($photo->id);
            }

            \DB::commit();
            return redirect('music/artist');
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
     * @return RedirectResponse|Redirector|array
     * @throws \Exception
     */
    public function destroy(Artist $artist)
    {
        try {
            $artist->delete();

            return redirect('music/artist');
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
* @return RedirectResponse|Redirector|array
*/
    public function restore(Request $request)
    {
        try {
            Artist::onlyTrashed()->findOrFail($request->id)->restore();

            return redirect('music/artist');

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
