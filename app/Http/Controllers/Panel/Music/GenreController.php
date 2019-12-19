<?php

namespace App\Http\Controllers\Panel\Music;

use App\Http\Controllers\Controller;
use App\Http\Requests\Music\Genre\StoreGenreRequest;
use App\Http\Requests\Music\Genre\UpdateGenreRequest;
use App\Http\Resources\Music\Genre\GenreIndexResource;
use App\Http\Resources\Music\Genre\GenreShowResource;
use App\Models\Music\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|object
     */
    public function index()
    {
        $genre = Genre::paginate();
        return GenreIndexResource::collection($genre);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response|array
     */
    public function store(StoreGenreRequest $request)
    {
        \DB::beginTransaction();

        try {
            $genre = new Genre();

            $translations = [
                'name_fa' => $request->name['fa'],
                'name_en' => $request->name['en'],
            ];

            $genre->setTranslations('name', $translations);

            $genre->fill($request->all());
//        $genre->songs()->attach(1);
            $genre->save();
            \DB::commit();
            return [
                'success' => true,
                'message' => trans('responses.panel.music.message.store'),
            ];

        } catch (\Exception $exception) {
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
     * @param Genre $genre
     *
     * @return \Illuminate\Http\Response|object
     */
    public function show(Genre $genre)
    {
        return new GenreShowResource($genre);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGenreRequest $request
     * @param Genre              $genre
     *
     * @return array
     */
    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        \DB::beginTransaction();

        try {
            $translations = [
                'name_fa' => $request->name['fa'],
                'name_en' => $request->name['en'],
            ];
            $genre->setTranslations('name', $translations);

            $genre->fill($request->all());
            $genre->save();

            \DB::commit();

            return [
                'success' => true,
                'message' => trans('responses.panel.music.message.update'),
            ];

        } catch (\Exception $exception) {
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
     * @param Genre $genre
     *
     * @return void|array
     * @throws \Exception
     */
    public function destroy(Genre $genre)
    {
        try {
            $genre->delete();
            return [
                'success' => true,
                'message' => trans('responses.panel.music.message.delete'),
            ];
        } catch (\Exception $exception) {
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
     * @return void|array
     * @throws \Exception
     */
    public function restore($id)
    {
        \DB::beginTransaction();
        try {
            Genre::onlyTrashed()->findOrFail($id)->restore();

            \DB::commit();

            return [
                'success' => true,
                'message' => trans('responses.panel.music.message.delete'),
            ];

        } catch (\Exception $exception) {
            \DB::rollBack();

            return [
                'success' => false,
                'message' => $exception->getMessage(),
            ];
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|object
     */
    public function list()
    {
        return Genre::select('id' , 'name')->get();
    }
}
