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
    if (auth()->check()) {
        return redirect()->route('home');
    }
    return view('welcome');
});

Route::get('/firebase','FirebaseController@index')->name('firebase.index');

// Route::namespace('Staff')->name('Staff.')->prefix('Staff')->group(function () {
//     Route::get('login', 'StaffAuthController@getLogin')->name('login');
//     Route::post('login', 'StaffAuthController@postLogin');
// });

// Route::namespace('Student')->name('student.')->prefix('student')->group(function () {
//     Route::get('login', 'StudentAuthController@getLogin')->name('login');
//     Route::post('login', 'StudentAuthController@postLogin');
// });

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/logout', function () {
    auth()->logout();

    return 'You are now logged out';
});

Auth::routes([
    'register' => true
]);

Route::get('/home', 'HomeController@index')->name('home');


#ADMIN
Route::prefix('/admin')->name('admin')->group(function () {
    // Route::get('/order/{order}/edit', 'Admin\OrderController@edit')->name('.order.edit');
    // Route::delete('/order/{order}', 'Admin\OrderController@destroy')->name('.order.destroy');
    // Route::put('/order/{order}', 'Admin\OrderController@update')->name('.order.update');

    // Route::get('/webhook/index', 'Admin\WebhookController@index')->name('.webhook.index');
    // Route::post('/webhook/reprocessAll', 'Admin\WebhookController@reprocessAll')->name('.webhook.reprocessAll');
    // Route::get('/webhook/{webhook}', 'Admin\WebhookController@show')->name('.webhook.show');
    // Route::post('/webhook/{webhook}', 'Admin\WebhookController@reprocess')->name('.webhook.reprocess');
});

#STUDENT

Route::get('users','UserController@getUsers');


## User CRUD
Route::prefix('/user')->name('user.')->group(function () {
    Route::get('/index', 'UserController@index')->name('index');
    Route::get('/profile/{user}', 'UserController@profile')->name('profile');
    Route::get('/create', 'UserController@create')->name('create');
    Route::post('/', 'UserController@store')->name('store');
    Route::get('/{user}', 'UserController@show')->name('show');
    Route::get('/{user}/edit', 'UserController@edit')->name('edit');
    Route::delete('/{user}', 'UserController@destroy')->name('destroy');
    Route::put('/{user}', 'UserController@update')->name('update');
});

## Student CRUD
Route::prefix('/student')->name('student.')->group(function () {
    Route::get('/student_register','StudentController@register')->name('register');
    Route::get('/student_details/{user}', 'StudentController@details')->name('student_details');
    Route::post('/student_details/{user}', 'StudentController@storeDetails')->name('store_details');
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
Route::prefix('/result')->name('result.')->group(function () {
    Route::get('/index', 'ResultController@index')->name('index');
    Route::get('/create', 'ResultController@create')->name('create');
    Route::post('/', 'ResultController@store')->name('store');
    Route::get('/{result}', 'ResultController@show')->name('show');
    Route::get('/{result}/export', 'ResultController@export')->name('export');
    Route::get('/{result}/edit', 'ResultController@edit')->name('edit');
    Route::delete('/{result}', 'ResultController@destroy')->name('destroy');
    Route::put('/{result}', 'ResultController@update')->name('update');
});

## Personality Assessment
Route::prefix('/test')->name('test.')->group(function () {
    Route::get('/start', 'TestController@start')->name('start');
    Route::get('/answer', 'TestController@index')->name('answer');
    // Route::get('/previous', 'TestController@index')->name('previous');
    Route::get('/reset', 'TestController@index')->name('reset');
    Route::post('/submit', 'TestController@store')->name('submit');
    Route::get('/result', 'TestController@show')->name('result');
});

## Results
Route::prefix('/result')->name('result.')->group(function () {
    Route::get('/index', 'ResultController@index')->name('index');
    Route::get('/show', 'ResultController@index2')->name('show');
});
