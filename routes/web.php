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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin', function () { return view('admin'); })->middleware('checkRole:admin');
Route::get('user', function () { return view('user'); })->middleware(['checkRole:user,admin']);Auth::routes();
Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update'])->middleware('checkRole:admin');
Route::post('profile', ['as' => 'profile.delete', 'uses' => 'ProfileController@delete_user'])->middleware('checkRole:admin');
Route::resource('user', 'UserController', ['except' => ['show']])->middleware(['checkRole:user,admin']);Auth::routes();
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});


