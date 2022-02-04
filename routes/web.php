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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => '/admin'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/persons', [App\Http\Controllers\PersonController::class, 'index'])->name('persons.index');
    Route::get('/persons/create/{id?}', [App\Http\Controllers\PersonController::class, 'create'])->name('persons.create');
    Route::get('/persons/delete/{id}', [App\Http\Controllers\PersonController::class, 'delete'])->name('persons.delete');
    Route::post('/persons/store', [App\Http\Controllers\PersonController::class, 'store'])->name('persons.store');

    Route::get('/vaccines', [App\Http\Controllers\VaccineController::class, 'index'])->name('vaccines.index');
    Route::get('/vaccines/create/{id?}', [App\Http\Controllers\VaccineController::class, 'create'])->name('vaccines.create');
    Route::get('/vaccines/delete/{id}', [App\Http\Controllers\VaccineController::class, 'delete'])->name('vaccines.delete');
    Route::post('/vaccines/store', [App\Http\Controllers\VaccineController::class, 'store'])->name('vaccines.store');

    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/create/{id?}', [App\Http\Controllers\NotificationController::class, 'create'])->name('notifications.create');
    Route::get('/notifications/delete/{id}', [App\Http\Controllers\NotificationController::class, 'delete'])->name('notifications.delete');
    Route::post('/notifications/store', [App\Http\Controllers\NotificationController::class, 'store'])->name('notifications.store');
});
