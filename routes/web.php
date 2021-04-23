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

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/logout', function () {
    auth()->logout();

    return 'You are now logged out';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

## User CRUD
Route::prefix('/user')->name('user.')->group(function () {
    Route::get('/index', 'UsersController@index')->name('index');
    Route::get('/create', 'UsersController@create')->name('create');
    Route::post('/', 'UsersController@store')->name('store');
    Route::get('/{user}', 'UsersController@show')->name('show');
    Route::get('/{user}/edit', 'UsersController@edit')->name('edit');
    Route::delete('/{user}', 'UsersController@destroy')->name('destroy');
    Route::put('/{user}', 'UsersController@update')->name('update');
});

## Student CRUD
Route::prefix('/student')->name('student.')->group(function () {
    Route::get('/index', 'StudentController@index')->name('index');
    Route::get('/create', 'StudentController@create')->name('create');
    Route::post('/', 'StudentController@store')->name('store');
    Route::get('/{student}', 'StudentController@show')->name('show');
    Route::get('/{student}/edit', 'StudentController@edit')->name('edit');
    Route::delete('/{student}', 'StudentController@destroy')->name('destroy');
    Route::put('/{student}', 'StudentController@update')->name('update');
});

## Question CRUD
Route::prefix('/question')->name('question.')->group(function () {
    Route::get('/settings', 'QuestionController@settings')->name('settings');
    Route::get('/index', 'QuestionController@index')->name('index');
    Route::get('/create', 'QuestionController@create')->name('create');
    Route::post('/', 'QuestionController@store')->name('store');
    Route::post('/settings/store', 'QuestionController@storeSettings')->name('store_settings');
    Route::get('/{question}', 'QuestionController@show')->name('show');
    Route::get('/{question}/edit', 'QuestionController@edit')->name('edit');
    Route::delete('/{question}', 'QuestionController@destroy')->name('destroy');
    Route::put('/{question}', 'QuestionController@update')->name('update');
});

## Report CRUD
Route::prefix('/report')->name('report.')->group(function () {
    Route::get('/index', 'ReportController@index')->name('index');
    Route::get('/create', 'ReportController@create')->name('create');
    Route::post('/', 'ReportController@store')->name('store');
    Route::get('/{report}', 'ReportController@show')->name('show');
    Route::get('/{report}/edit', 'ReportController@edit')->name('edit');
    Route::delete('/{report}', 'ReportController@destroy')->name('destroy');
    Route::put('/{report}', 'ReportController@update')->name('update');
});

## Personality Assessment
Route::prefix('/test')->name('test.')->group(function () {
    Route::get('/start', 'TestController@index')->name('start');
    Route::get('/next', 'TestController@index2')->name('next');
    Route::get('/previous', 'TestController@index')->name('previous');
    Route::get('/reset', 'TestController@index')->name('reset');
    Route::post('/', 'TestController@store')->name('submit');
    Route::get('/result', 'TestController@show')->name('results.show');
});

Route::get('/students_register', function () {
    return view('register_student');
});

Route::get('/students_details', function () {
    return view('details_student');
});

Route::get('/start_test', function () {
    return view('test');
});

Route::get('/test/page/2', function () {
    return view('test2');
});

Route::get('/result', function () {
    return view('result');
});