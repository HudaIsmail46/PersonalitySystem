<?php

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
    return view('welcome');
});

Route::get('/logout', function () {
    auth()->logout();
    
    return 'You are now logged out';
});

Route::get('booking', function () {

    $bookings = DB::table('booking')->get();

    return view('booking.show', ['booking' => $bookings]);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('import-excel', 'ImportExcel\ImportExcelController@index');
Route::post('import-excel', 'ImportExcel\ImportExcelController@import');

//show - list of booking
//index - get a booking

Route::get('booking', 'BookingController@show');
Route::get('booking/create', 'BookingController@create');
Route::get('booking/{bookings}', 'BookingController@index')->name('booking.index');
Route::get('booking/{booking}/edit', 'BookingController@edit');
Route::put('booking/{booking}', 'BookingController@update');
