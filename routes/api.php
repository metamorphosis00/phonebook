<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('contact')->group(function() {
    Route::post('create', 'ContactController@store');
    Route::get('edit/{id}', 'ContactController@edit');
    Route::post('update/{id}', 'ContactController@update');
    Route::delete('delete/{id}', 'ContactController@delete');
});

Route::get('/contacts', 'ContactController@index');
