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
Route::group(['namespace' => 'Frontend'] , function (){
    Route::get('artist/{id}' , 'ArtistController@show');
});
// ------------------- Panel/Music/Routes ------------------------

Route::group(['namespace' => 'Panel'], function () {
    Route::group(['namespace' => 'Music', 'prefix' => 'music', 'middleware' => 'auth'], function () {

        Route::get('/album/list', 'AlbumController@list');
        Route::post('/album/{id}/restore', 'AlbumController@restore');
        Route::apiResource('/album', 'AlbumController');

        Route::get('/genre/list', 'GenreController@list');
        Route::post('/genre/{id}/restore', 'GenreController@restore');
        Route::apiResource('/genre', 'GenreController');

        Route::get('/category/list', 'CategoryController@list');
        Route::post('/category/{id}/restore', 'CategoryController@restore');
        Route::apiResource('/category', 'CategoryController');

        Route::get('/artist/list', 'ArtistController@list');
        Route::post('/artist/{id}/restore', 'ArtistController@restore');
        Route::apiResource('/artist', 'ArtistController');

        Route::get('/song/list', 'SongController@list');
        Route::post('/song/{id}/restore', 'SongController@restore');
        Route::apiResource('/song', 'SongController');
    });
});

