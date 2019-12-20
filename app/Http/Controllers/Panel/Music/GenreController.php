<?php

namespace App\Http\Controllers\Panel\Music;

use App\Http\Controllers\Controller;
use App\Http\Requests\Music\Genre\StoreGenreRequest;
use App\Http\Requests\Music\Genre\UpdateGenreRequest;
use App\Http\Resources\Music\Genre\GenreIndexResource;
use App\Http\Resources\Music\Genre\GenreShowResource;
use App\Models\Music\Genre;
use Illuminate\Http\RedirectResponse;use Illuminate\Http\Request;use Illuminate\Routing\Redirector;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|object
     */
    public function index()
    {
        $pure_data = Genre::paginate();
        $obj = GenreIndexResource::collection($pure_data)->resource;
        $genres = json_decode(json_encode($obj))->data;
        return view('genre.index' , compact('genres' , 'pure_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGenreRequest $request
     *
     * @return RedirectResponse|Redirector|array
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
            $genre->save();
            \DB::commit();
            return redirect('music/genre');

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

    public function edit(Genre $genre)
    {
        $obj = new GenreIndexResource($genre);
        $genre = json_decode(json_encode($obj),true);
        return view('genre.update' , compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGenreRequest $request
     * @param Genre              $genre
     *
     * @return RedirectResponse|Redirector|array
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

            return redirect('music/genre');

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
     * @return RedirectResponse|Redirector|array
     * @throws \Exception
     */
    public function destroy(Genre $genre)
    {
        try {
            $genre->delete();
            return redirect('music/genre');
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
     * @param Request $request
     *
     * @return RedirectResponse|Redirector|array
     */
    public function restore(Request $request)
    {
        \DB::beginTransaction();
        try {
            Genre::onlyTrashed()->findOrFail($request->id)->restore();

            \DB::commit();

            return redirect('music/genre');

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
