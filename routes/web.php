<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// ------------------- Home ------------------------


Route::get('/', function () {
    return view('welcome');
});

// ------------------- Login & Logout ------------------------

Route::group(['namespace' => 'Auth'], function () {
    Route::post('/login', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout');
});
Route::group(['namespace' => 'Frontend'], function () {
    Route::get('artist/{id}', 'ArtistController@show');
});
// ------------------- Panel/Music/Routes ------------------------

Route::group(['namespace' => 'Panel'], function () {
    Route::group(['namespace' => 'Music', 'prefix' => 'music', 'middleware' => 'auth'], function () {


        // ------------------- Album ------------------------

        Route::get('/album/create', function () {
            return view('album.create');
        });
        Route::get('/updatealbum/{album}' , 'AlbumController@edit');
        Route::get('/album/list', 'AlbumController@list');
        Route::post('/album/restore', 'AlbumController@restore');
        Route::apiResource('/album', 'AlbumController');


        // ------------------- Genre ------------------------

        Route::get('/genre/create', function () {
            return view('genre.create');
        });
        Route::get('/updategenre/{genre}' , 'GenreController@edit');
        Route::get('/genre/list', 'GenreController@list');
        Route::post('/genre/restore', 'GenreController@restore');
        Route::apiResource('/genre', 'GenreController');

        // ------------------- Category ------------------------

        Route::get('/category/create', function () {
            return view('category.create');
        });
        Route::get('/updatecat/{category}' , 'CategoryController@edit');
        Route::get('/category/list', 'CategoryController@list');
        Route::post('/category/restore', 'CategoryController@restore');
        Route::apiResource('/category', 'CategoryController');

        // ------------------- Artist ------------------------

        Route::get('/artist/create', function () {
            return view('artist.create');
        });
        Route::get('/updateart/{artist}' , 'ArtistController@edit');
        Route::get('/artist/list', 'ArtistController@list');
        Route::post('/artist/restore', 'ArtistController@restore');
        Route::apiResource('/artist', 'ArtistController');


        // ------------------- Song ------------------------

        Route::get('/song/create', 'SongController@create');
        Route::get('/updatesong/{song}', 'SongController@edit');
        Route::get('/song/list', 'SongController@list');
        Route::post('/song/restore', 'SongController@restore');
        Route::apiResource('/song', 'SongController');

        // ------------------- photo ------------------------

        Route::get('/photo' , 'PhotoController@show');
    });
});


Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');
