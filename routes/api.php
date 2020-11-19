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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::webhooks('webhook/aafinance', 'aafinance');
Route::webhooks('webhook/booking', 'booking');

// Route::post('/image', 'ImageController@store')->name('image.store');
// Route::post('/image', 'ImageController@update')->name('image.update');
