<?php

use Illuminate\Support\Facades\Route;
use App\Movie;

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

Route::get('/', function () {
    return view('movieInfo');
});

//Route::get(‘/test’, function() {
//    $movie = new Movie();
//    dd($movie->getTable());
//});

// TODO::デバッグのとき使える方法
Route::get('test', function () {
    $movie = \App\Models\Movie::all();
    dd($movie);
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

