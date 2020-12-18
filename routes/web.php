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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->middleware('can:manage-users')->name('admin.')->group(function(){
    Route::resource('/users', UsersController::class);

});
Route::get('/search', [App\Http\Controllers\Admin\UsersController::class, 'search'])->name('search-user');

Route::namespace('App\Http\Controllers')->name('certificates.')->group(function(){
    Route::resource('/certificate', CertificateController::class);

});
Route::get('/search-certificate', [App\Http\Controllers\CertificateController::class, 'search'])->name('search-certificate');

Route::namespace('App\Http\Controllers')->name('trainings.')->group(function(){
    Route::resource('/training', TrainingsController::class);

});
Route::get('/search-training', [App\Http\Controllers\TrainingsController::class, 'search'])->name('search-training');

Route::namespace('App\Http\Controllers')->name('designations.')->group(function(){
    Route::resource('/designation', DesignationController::class);

});
Route::get('/search-designation', [App\Http\Controllers\DesignationController::class, 'search'])->name('search-designation');