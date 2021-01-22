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
Route::get('/booking_products/import-excel', 'ImportExcel\ImportExcelController@productIndex')->name('booking_product.import.new');
Route::post('/booking_products/import-excel', 'ImportExcel\ImportExcelController@productImport')->name('booking_product.import');

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
Route::prefix('/order')->name('order.')->group(function () {
    Route::get('/index', 'OrderController@index')->name('index');
    Route::get('/create', 'OrderController@create')->name('create');
    Route::post('/', 'OrderController@store')->name('store');
    Route::get('/{order}', 'OrderController@show')->name('show');
    Route::get('/{order}/edit', 'OrderController@edit')->name('edit');
    Route::delete('/{order}', 'OrderController@destroy')->name('destroy');
    Route::put('/{order}', 'OrderController@update')->name('update');
    Route::post('/status/{order}', 'OrderController@status')->name('status');
});

##External order CRUD
Route::prefix('external/order')->name('external.order.')->group(function () {
    Route::get('/index', 'External\OrderController@index')->name('index');
    Route::get('/{order}', 'External\OrderController@show')->name('show');
});

##RunnerSchedule CRUD
Route::prefix('/runner_schedule')->name('runner_schedule.')->group(function () {
    Route::get('/index', 'RunnerScheduleController@index')->name('index');
    Route::get('/create', 'RunnerScheduleController@create')->name('create');
    Route::post('/', 'RunnerScheduleController@store')->name('store');
    Route::get('/{runner_schedule}', 'RunnerScheduleController@show')->name('show');
    Route::get('/{runner_schedule}/edit', 'RunnerScheduleController@edit')->name('edit');
    Route::delete('/{runner_schedule}', 'RunnerScheduleController@destroy')->name('destroy');
    Route::put('/{runner_schedule}', 'RunnerScheduleController@update')->name('update');
});

##External RunnerSchedule CRUD
Route::prefix('external/runner_schedule')->name('external.runner_schedule.')->group(function () {
    Route::get('/index', 'External\RunnerScheduleController@index')->name('index');
    Route::get('/{runner_schedule}', 'External\RunnerScheduleController@show')->name('show');
});

##RunnerJob CRUD
Route::prefix('/runner_job')->name('runner_job.')->group(function () {
    Route::get('/', 'RunnerJobController@index')->name('index');
    Route::get('/create', 'RunnerJobController@create')->name('create');
    Route::post('/', 'RunnerJobController@store')->name('store');
    Route::get('/{runner_job}', 'RunnerJobController@show')->name('show');
    Route::get('/{runner_job}/edit', 'RunnerJobController@edit')->name('edit');
    Route::delete('/{runner_job}', 'RunnerJobController@destroy')->name('destroy');
    Route::put('/{runner_job}', 'RunnerJobController@update')->name('update');
    Route::put('/complete/{runner_job}', 'RunnerJobController@complete')->name('complete');
    Route::put('/abort/{runner_job}', 'RunnerJobController@abort')->name('abort');
});

##External RunnerJob CRUD
Route::prefix('/external/runner_job')->name('external.runner_job.')->group(function () {
    Route::get('/{runner_job}', 'External\RunnerJobController@show')->name('show');
    Route::put('/complete/{runner_job}', 'External\RunnerJobController@complete')->name('complete');
    Route::put('/abort/{runner_job}', 'External\RunnerJobController@abort')->name('abort');
});

##External Runner CRUD
Route::prefix('/external/runner')->name('external.runner.')->group(function () {
    Route::get('/index', 'External\RunnerController@index')->name('index');
    Route::get('/{runner_schedule}', 'External\RunnerController@show')->name('show');
    Route::put('/{runner_schedule}', 'External\RunnerController@start')->name('start');
});

#image
Route::post('/image', 'ImageController@store')->name('image.store');
Route::delete('/image/delete', 'ImageController@destroy')->name('image.destroy');

#comment
Route::post('/comment', 'CommentController@store')->name('comment.store');
Route::delete('/comment/{comment}', 'CommentController@destroy')->name('comment.destroy');

#inHouseCleaning
Route::get('/inhouse_cleaning/index', 'InHouseCleaningController@index')->name('inhouse_cleaning.index');

#External CustomerOrder
Route::get('/external/customer/order/{orderId}', 'External\CustomerOrderController@show')->name('customer_order.show');

#PDF
Route::get('/pdfconverter/{orderId}', 'External\CustomerOrderController@pdf')->name('customer_order.pdf');

#ADMIN
##order CRUD
Route::prefix('/admin')->name('admin')->group(function () {
    Route::get('/order/{order}/edit', 'Admin\OrderController@edit')->name('.order.edit');
    Route::delete('/order/{order}', 'Admin\OrderController@destroy')->name('.order.destroy');
    Route::put('/order/{order}', 'Admin\OrderController@update')->name('.order.update');

    Route::get('/webhook/index', 'Admin\WebhookController@index')->name('.webhook.index');
    Route::get('/webhook/{webhook}', 'Admin\WebhookController@show')->name('.webhook.show');
});

##member CRUD
Route::prefix('/member')->name('member.')->group(function () {
    Route::get('/index', 'MemberController@index')->name('index');
    Route::get('/create', 'MemberController@create')->name('create');
    Route::post('/', 'MemberController@store')->name('store');
    Route::get('/{member}', 'MemberController@show')->name('show');
    Route::get('/{member}/edit', 'MemberController@edit')->name('edit');
    Route::delete('/{member}', 'MemberController@destroy')->name('destroy');
    Route::put('/{member}', 'MemberController@update')->name('update');
});

##team CRUD
Route::prefix('/team')->name('team.')->group(function () {
    Route::get('/index', 'TeamController@index')->name('index');
    Route::get('/create', 'TeamController@create')->name('create');
    Route::post('/', 'TeamController@store')->name('store');
    Route::get('/{team}', 'TeamController@show')->name('show');
    Route::get('/{team}/edit', 'TeamController@edit')->name('edit');
    Route::delete('/{team}', 'TeamController@destroy')->name('destroy');
    Route::put('/{team}', 'TeamController@update')->name('update');
});

##teamMember CRUD
Route::prefix('/team_member')->name('team_member.')->group(function () {
    Route::get('/index', 'TeamMemberController@index')->name('index');
    Route::get('/create', 'TeamMemberController@create')->name('create');
    Route::post('/', 'TeamMemberController@store')->name('store');
    Route::get('/{team_member}/edit', 'TeamMemberController@edit')->name('edit');
    Route::delete('/{team_member}', 'TeamMemberController@destroy')->name('destroy');
    Route::put('/{team_member}', 'TeamMemberController@update')->name('update');
});

##vehicle CRUD
Route::prefix('/vehicle')->name('vehicle.')->group(function () {
    Route::get('/index', 'VehicleController@index')->name('index');
    Route::get('/create', 'VehicleController@create')->name('create');
    Route::post('/', 'VehicleController@store')->name('store');
    Route::get('/{vehicle}', 'VehicleController@show')->name('show');
    Route::get('/{vehicle}/edit', 'VehicleController@edit')->name('edit');
    Route::delete('/{vehicle}', 'VehicleController@destroy')->name('destroy');
    Route::put('/{vehicle}', 'VehicleController@update')->name('update');
});

##payment
Route::get('/pay/{order}', 'External\SenangPaymentController@pay')->name('pay');
Route::get('/senang/return', 'External\SenangPaymentController@senangReturn');#

##role
Route::prefix('/role')->name('role.')->group(function () {
    Route::get('/index', 'RoleController@index')->name('index');
    Route::get('/create', 'RoleController@create')->name('create');
    Route::post('/', 'RoleController@store')->name('store');
    Route::get('/{role}', 'RoleController@show')->name('show');
    Route::get('/{role}/edit', 'RoleController@edit')->name('edit');
    Route::delete('/{role}', 'RoleController@destroy')->name('destroy');
    Route::put('/{role}', 'RoleController@update')->name('update');
});