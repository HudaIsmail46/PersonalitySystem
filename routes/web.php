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
    // if (auth()->check()) {
    //     return redirect()->route('home');
    // }
    return view('welcome');
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

Route::get('/logout', function () {
    auth()->logout();

    return 'You are now logged out';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

## Question CRUD
Route::prefix('/question')->name('question.')->group(function () {
    Route::get('/settings', 'QuestionController@settings')->name('settings');
    Route::get('/index', 'QuestionController@index')->name('index');
    Route::get('/create', 'QuestionController@create')->name('create');
    Route::post('/', 'QuestionController@store')->name('store');
    Route::get('/{question}', 'QuestionController@show')->name('show');
    Route::get('/{question}/edit', 'QuestionController@edit')->name('edit');
    Route::delete('/{question}', 'QuestionController@destroy')->name('destroy');
    Route::put('/{question}', 'QuestionController@update')->name('update');
    Route::post('/{question}/purchase_insurance', 'QuestionController@purchase_insurance')->name('purchase_insurance');
});
