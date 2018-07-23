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

Route::get('/', 'PagesController@index');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@getRegisterForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/auth/activate', 'Auth\ActivationController@activate')->name('auth.activate');
Route::get('/auth/activate/resend', 'Auth\ActivationResendController@showResendForm')->name('auth.activate.resend');
Route::post('/auth/activate/resend', 'Auth\ActivationResendController@resend');
Route::get('/auth/password/change', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.password.change');
Route::post('/auth/password/change', 'Auth\ChangePasswordController@changePassword');

//Trips routes
Route::get('/trips', 'TripsController@index')->name('trips.index');
Route::get('/trips/create', 'TripsController@create')->name('trips.create');
Route::post('/trips/store', 'TripsController@store')->name('trips.store');
Route::get('/trips/{trip_id}', 'TripsController@show')->name('trips.trip');
Route::get('/trips/{trip_id}/edit', 'TripsController@edit')->name('trips.trip.edit');
Route::post('/trips/{trip_id}/update', 'TripsController@update')->name('trips.trip.update');
Route::get('/trips/{trip_id}/destroy', 'TripsController@destroy')->name('trips.trip.destroy');
Route::get('/trips/{trip_id}/delete', 'TripsController@delete')->name('trips.trip.delete');

//Buses routes

Route::get('/trips/{trip_id}/bus/create', 'BusesController@create')->name('buses.create');
Route::post('/trips/{trip_id}/bus/store', 'BusesController@store')->name('buses.store');
Route::get('/trips/{trip_id}/bus/{bus_id}/edit', 'BusesController@edit')->name('buses.edit');
Route::post('/trips/{trip_id}/bus/{bus_id}/update', 'BusesController@update')->name('buses.update');
Route::get('/trips/{trip_id}/bus/{bus_id}/delete', 'BusesController@delete')->name('buses.delete');
Route::post('/trips/{trip_id}/bus/{bus_id}/destroy', 'BusesController@destroy')->name('buses.destroy');

//Hotels routes

Route::get('/trips/{trip_id}/hotel/create', 'HotelsController@create')->name('hotels.create');
Route::post('/trips/{trip_id}/hotel/store', 'HotelsController@store')->name('hotels.store');
Route::get('/trips/{trip_id}/hotel/{hotel_id}/edit', 'HotelsController@edit')->name('Hotels.edit');
Route::post('/trips/{trip_id}/hotel/{hotel_id}/update', 'HotelsController@update')->name('hotels.update');
Route::get('/trips/{trip_id}/hotel/{hotel_id}/delete', 'HotelsController@delete')->name('hotels.delete');
Route::post('/trips/{trip_id}/hotel/{hotel_id}/destroy', 'HotelsController@destroy')->name('hotels.destroy');

//Excursions routes

Route::get('/trips/{trip_id}/excursion/create', 'ExcursionsController@create')->name('excursions.create');
Route::post('/trips/{trip_id}/excursion/store', 'ExcursionsController@store')->name('excursions.store');
Route::get('/trips/{trip_id}/excursion/{excursion_id}/edit', 'ExcursionsController@edit')->name('Excursions.edit');
Route::post('/trips/{trip_id}/excursion/{excursion_id}/update', 'ExcursionsController@update')->name('excursions.update');
Route::get('/trips/{trip_id}/excursion/{excursion_id}/delete', 'ExcursionsController@delete')->name('excursions.delete');
Route::post('/trips/{trip_id}/excursion/{excursion_id}/destroy', 'ExcursionsController@destroy')->name('excursions.destroy');

//Packages routes

Route::get('/trips/{trip_id}/package/create', 'PackagesController@create')->name('packages.create');
Route::post('/trips/{trip_id}/package/store', 'PackagesController@store')->name('packages.store');
Route::get('/trips/{trip_id}/package/{package_id}/edit', 'PackagesController@edit')->name('Packages.edit');
Route::post('/trips/{trip_id}/package/{package_id}/update', 'PackagesController@update')->name('packages.update');
Route::get('/trips/{trip_id}/package/{package_id}/delete', 'PackagesController@delete')->name('packages.delete');
Route::post('/trips/{trip_id}/package/{package_id}/destroy', 'PackagesController@destroy')->name('packages.destroy');

//Purchases routes
Route::get('/trips/{trip_id}/purchase', 'PurchasesController@index')->name('purchases.index');
Route::get('/trips/{trip_id}/purchase/create', 'PurchasesController@create')->name('purchases.create');
Route::post('/trips/{trip_id}/purchase/store', 'PurchasesController@store')->name('purchases.store');
Route::get('/trips/{trip_id}/purchase/{purchase_id}', 'PurchasesController@show')->name('purchases.show');
Route::get('/trips/{trip_id}/purchase/{purchase_id}/show', 'PurchasesController@confirmPurchase')->name('purchases.confirm');
Route::post('/trips/{trip_id}/purchase/{purchase_id}/confirmed', 'PurchasesController@confirmedPurchase')->name('purchases.confirmed');
Route::get('/trips/{trip_id}/purchase/{purchase_id}/edit', 'PurchasesController@edit')->name('purchases.edit');
Route::post('/trips/{trip_id}/purchase/{purchase_id}/update', 'PurchasesController@update')->name('purchases.update');
Route::get('/trips/{trip_id}/purchase/{purchase_id}/destroy', 'PurchasesController@destroy')->name('purchases.destroy');
Route::get('/trips/{trip_id}/purchase/{purchase_id}/delete', 'PurchasesController@delete')->name('purchases.delete');

//Users routes
Route::get('/admin/users', 'UserController@index')->name('users.index');
Route::get('/admin/users/create', 'UserController@create')->name('users.create');
Route::get('/admin/users/store', 'UserController@store')->name('users.store');
Route::get('/admin/users/{user_id}/edit', 'UserController@edit')->name('users.edit');
Route::post('/admin/users/{user_id}/update', 'UserController@update')->name('users.update');
Route::get('/admin/users/{user_id}/delete', 'UserController@delete')->name('users.delete');
Route::post('/admin/users/{user_id}/destroy', 'UserController@destroy')->name('users.destroy');

//PDF for sertificate
Route::get('/pdf', 'PDFController@downloadPDF');

//Result routes
Route::resource('results', 'ResultsController');


