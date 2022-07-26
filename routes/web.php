<?php

use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeasonsController;
use Illuminate\Support\Facades\Route;

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
    return redirect('/series');
});

Route::controller(SeriesController::class, SeasonsController::class)->group(function () {
    Route::get('/series', 'App\Http\Controllers\SeriesController@index');
    Route::get('/series/criar', 'App\Http\Controllers\SeriesController@create');
    Route::post('/series/salvar', 'App\Http\Controllers\SeriesController@store');
    Route::get('/series/editar/{id}', 'App\Http\Controllers\SeriesController@edit');
    Route::get('/series/atualizar/{id}', 'App\Http\Controllers\SeriesController@update');
    Route::delete('/series/destroy/{id}', 'App\Http\Controllers\SeriesController@destroy')->name('series.destroy');
    Route::get('/series/{series}/seasons', 'App\Http\Controllers\SeasonsController@index')->name('seasons.index');
});

//Route::put('/series/editar/{id}', 'App\Http\Controllers\SeriesController@edit');
