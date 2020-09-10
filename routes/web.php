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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

## Import
Route::get('import-excel', 'ImportExcel\ImportExcelController@index');
Route::post('import-excel', 'ImportExcel\ImportExcelController@import');

//index - list of booking
//show - get a booking

## View all
Route::get('/booking', 'BookingController@index')->name('booking.index');

## Create
Route::get('/booking/create', 'BookingController@create')->name('booking.create');
Route::post('/booking/store', 'BookingController@store')->name('booking.store');

## View one booking 
Route::get('/booking/{bookings}', 'BookingController@show')->name('booking.show');

## Update
Route::get('/booking/{bookings}/edit', 'BookingController@edit')->name('booking.edit');
Route::put('/booking/{bookings}', 'BookingController@update')->name('booking.update');

## Delete
Route::delete('booking/delete/{bookings}', 'BookingController@destroy')->name('booking.destroy');



