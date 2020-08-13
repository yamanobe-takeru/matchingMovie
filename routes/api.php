<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->prefix('/v1')->namespace('Api\V1')->group(function () {
    // Route::get('/movies', 'MovieController@index')->name('movies.index');
    Route::post('/movies', 'MovieController@store')->name('movies.create');
    Route::patch('/movies/{movie}', 'MovieController@update')->name('movies.update');
//    Route::patch('/movies/sad/{movie}', 'MovieController@sadCountUp')->name('movies.sadUp');
//    Route::patch('/movies/funny/{movie}', 'MovieController@funnyCountUp')->name('movies.funnyUp');
//    Route::patch('/movies/scare/{movie}', 'MovieController@scareCountUp')->name('movies.scareUp');
//    Route::patch('/movies/moved/{movie}', 'MovieController@movedCountUp')->name('movies.movedUp');
    Route::delete('/movies/{movie}', 'MovieController@delete')->name('movies.delete');

    //Route::get('/genres', 'GenreController@index')->name('genres.index');
    Route::get('/users', 'UserController@index')->name('users.index');
   // Route::get('/users/show', 'UserController@show')->name('users.show');
});

Route::prefix('/v1')->namespace('Api\V1')->group(function () {
    Route::get('/movies', 'MovieController@index')->name('movies.index');
    Route::patch('/movies/sad/{movie}', 'MovieController@sadCountUp')->name('movies.sadUp');
    Route::patch('/movies/funny/{movie}', 'MovieController@funnyCountUp')->name('movies.funnyUp');
    Route::patch('/movies/scare/{movie}', 'MovieController@scareCountUp')->name('movies.scareUp');
    Route::patch('/movies/moved/{movie}', 'MovieController@movedCountUp')->name('movies.movedUp');
    Route::get('/genres', 'GenreController@index')->name('genres.index');
});
