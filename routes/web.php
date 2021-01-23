<?php

use App\Events\Test;
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

Route::get('/', function () {return view('welcome');})->name('/');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/brpadcast', function () { broadcast(new Test()); })->name('/');

Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/masters/updateStatus', [App\Http\Controllers\MasterAdminController::class, 'updateStatus'])->name('master.updateStatus');
    Route::get('/masters', [App\Http\Controllers\MasterAdminController::class, 'index'])->name('masters.index');
    Route::get('/masters/{master}',[App\Http\Controllers\MasterAdminController::class, 'show'])->name('masters.index.show');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/nailJobs', [App\Http\Controllers\NailJobsAdminController::class, 'index'])->name('nailJobs.index');
    Route::post('/nailJobs/updateStatus',[App\Http\Controllers\NailJobsAdminController::class, 'updateStatus'])->name('nailJobs.updateStatus');
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/masterPoints/updateStatus',[App\Http\Controllers\MasterPointsAdminController::class, 'updateStatus'])->name('masterPoints.updateStatus');
    Route::get('/masterPoints',[App\Http\Controllers\MasterPointsAdminController::class, 'index'])->name('masterPoints.index');
});

