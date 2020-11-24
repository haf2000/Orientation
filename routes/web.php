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
Route::get('/refairetraitement', 'GestionMecaniqueController@refaire_traitement')->name('refairetraitement');

Route::get('/traitementGP', 'GestionProcedesController@pretraitement_traitement')->name('traitementGP');
Route::get('/refairetraitementGP', 'GestionProcedesController@refaire_traitement')->name('refairetraitementGP');

Route::get('/exportGMTotal','GestionMecaniqueController@export_GMtotal')->name('exportGMTotal');
Route::get('/exportGPTotal','GestionProcedesController@export_GPtotal')->name('exportGPTotal');


Route::get('/exportGMH','GestionMecaniqueController@export_section_H')->name('exportGMH');
Route::get('/exportGMI','GestionMecaniqueController@export_section_I')->name('exportGMI');
Route::get('/exportGMJ','GestionMecaniqueController@export_section_J')->name('exportGMJ');
Route::get('/exportGMK','GestionMecaniqueController@export_section_K')->name('exportGMK');
Route::get('/exportGML','GestionMecaniqueController@export_section_L')->name('exportGML');

Route::get('/exportGPC','GestionProcedesController@export_section_C')->name('exportGPC');
Route::get('/exportGPD','GestionProcedesController@export_section_D')->name('exportGPD');
Route::get('/exportGPE','GestionProcedesController@export_section_E')->name('exportGPE');
Route::get('/exportGPF','GestionProcedesController@export_section_F')->name('exportGPF');
Route::get('/exportGPG','GestionProcedesController@export_section_G')->name('exportGPG');

Route::get('/exportEnerg','GestionMecaniqueController@export_spec_L3E')->name('exportEnerg');
Route::get('/exportGM','GestionMecaniqueController@export_spec_L3GM')->name('exportGM');
Route::get('/exportCM','GestionMecaniqueController@export_spec_L3CM')->name('exportCM');

Route::get('/exportGP','GestionProcedesController@export_spec_L3GP')->name('exportGP');
Route::get('/exportRP','GestionProcedesController@export_spec_L3RP')->name('exportRP');

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

