<?php

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
//common routes
Route::match(['get', 'post'], '/', 'RoomController@showRooms');
//login routes
Route::group(['middleware' => 'guest'], function () {
	Route::get('login', 'LoginController@index');
	Route::get('/{role}', 'LoginController@memberLogin')->where('role', '(admin|manager)');
	Route::post('login', 'LoginController@authenticate')->name('login');
	Route::post('sign-up', 'SignupController@index')->name('sign-up');
});
//autherized routes
Route::group(['middleware' => 'autherized'], function () {
	Route::post('logout', 'LoginController@logout')->name('logout');
	Route::get('my-bookings', 'BookingController@index');
	Route::post('get-all-bookings', 'BookingController@getAll')->name('get-all-bookings');
	Route::post('confirm-booking', 'BookingController@confirmBooking');
	Route::post('get-room-details', 'RoomController@getRoomDetails');
});
//only admin routes
Route::group(['middleware' => ['autherized','admin']], function () {
	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	Route::resource('managers', 'ManagerController');
	Route::get('get-all-managers', 'ManagerController@getAll');
});
//both admin and managers routes
Route::group(['middleware' => ['autherized','management']], function () {
	Route::resource('rooms', 'RoomController');
	Route::resource('bookings', 'BookingController');
});
//ajax routes
Route::post('checkExist', 'AjaxController@checkExist');