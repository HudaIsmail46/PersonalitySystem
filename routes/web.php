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
    if(auth()->check()){
        return redirect()->route('home');
    }
    return view('welcome');
});

Route::get('/logout', function () {
    auth()->logout();

    return 'You are now logged out';
});

Auth::routes([
    'register' => false
]);

Route::get('/home', 'HomeController@index')->name('home');

## Import
Route::get('/bookings/import-excel', 'ImportExcel\ImportExcelController@index')->name('booking.import.new');
Route::post('/bookings/import-excel', 'ImportExcel\ImportExcelController@import')->name('booking.import');

## Booking CRUD
Route::prefix('/booking')->name('booking.')->group(function () {
    Route::get('/index', 'BookingController@index')->name('index');
    Route::get('/create', 'BookingController@create')->name('create');
    Route::post('/', 'BookingController@store')->name('store');
    Route::get('/{booking}', 'BookingController@show')->name('show');
    Route::get('/{booking}/edit', 'BookingController@edit')->name('edit');
    Route::delete('/{booking}', 'BookingController@destroy')->name('destroy');
    Route::put('/{booking}', 'BookingController@update')->name('update');
});

## Customer CRUD
Route::prefix('/customer')->name('customer.')->group(function () {
    Route::get('/index', 'CustomerController@index')->name('index');
    Route::get('/create', 'CustomerController@create')->name('create');
    Route::post('/', 'CustomerController@store')->name('store');
    Route::get('/{customer}', 'CustomerController@show')->name('show');
    Route::get('/{customer}/edit', 'CustomerController@edit')->name('edit');
    Route::delete('/{customer}', 'CustomerController@destroy')->name('destroy');
    Route::put('/{customer}', 'CustomerController@update')->name('update');
});

## User CRUD
Route::prefix('/user')->name('user.')->group(function () {
    Route::get('/index', 'UserController@index')->name('index');
    Route::get('/create', 'UserController@create')->name('create');
    Route::post('/', 'UserController@store')->name('store');
    Route::get('/{user}', 'UserController@show')->name('show');
    Route::get('/{user}/edit', 'UserController@edit')->name('edit');
    Route::delete('/{user}', 'UserController@destroy')->name('destroy');
    Route::put('/{user}', 'UserController@update')->name('update');
});

##order CRUD
Route::prefix('/order')->name('order.')->group(function(){
    Route::get('/', 'OrderController@index')->name('index');
    Route::get('/create', 'OrderController@create')->name('create');
    Route::post('/', 'OrderController@store')->name('store');
    Route::get('/{order}', 'OrderController@show')->name('show');
    Route::get('/{order}/edit', 'OrderController@edit')->name('edit');
    Route::delete('/{order}', 'OrderController@destroy')->name('destroy');
    Route::put('/{order}', 'OrderController@update')->name('update');
});

##Runner CRUD
Route::prefix('/runner_schedule')->name('runner_schedule.')->group(function () {
    Route::get('/', 'RunnerScheduleController@index')->name('index');
    Route::get('/create', 'RunnerScheduleController@create')->name('create');
    Route::post('/', 'RunnerScheduleController@store')->name('store');
    Route::get('/{runner_schedule}', 'RunnerScheduleController@show')->name('show');
    Route::get('/{runner_schedule}/edit', 'RunnerScheduleController@edit')->name('edit');
    Route::delete('/{runner_schedule}', 'RunnerScheduleController@destroy')->name('destroy');
    Route::put('/{runner_schedule}', 'RunnerScheduleController@update')->name('update');
});




