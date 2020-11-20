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
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/gm', 'GmController@gm')->name('gm');
Route::get('/gp', 'GpController@gp')->name('gp');
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

//Route::get('export', 'ImportExportController@export')->name('export');
//Route::post('import', 'ImportL2GMController@import')->name('import');
//Route::post('import2', 'ImportL2GMController@test')->name('import2');
Route::post('import', 'ImportL2GMController@import')->name('import');
Route::post('importL3GM', 'ImportL3GMController@import')->name('importL3GM');
Route::post('importFVGM', 'ImportFVGMController@import')->name('importFVGM');

Route::post('importL2GP', 'ImportL2GPController@import')->name('importL2GP');
Route::post('importL3GP', 'ImportL3GPController@import')->name('importL3GP');
Route::post('importFVGP', 'ImportFVGPController@import')->name('importFVGP');


Route::get('/traitement', 'GestionMecaniqueController@pretraitement_traitement')->name('traitement');
Route::get('/traitementGP', 'GestionProcedesController@pretraitement_traitement')->name('traitementGP');

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
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

