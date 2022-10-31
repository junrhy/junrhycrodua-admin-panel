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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('endpoints', App\Http\Controllers\EndpointController::class)->middleware(['auth']);
Route::resource('staffs', App\Http\Controllers\StaffController::class)->middleware(['auth']);

Route::get('tables/create/{id}', [EndpointController::class, 'createTableRecord'])->middleware(['auth']);
Route::post('tables', [EndpointController::class, 'downloadTableRecord'])->middleware(['auth']);
Route::delete('tables/{id}', [EndpointController::class, 'removeTableRecord'])->middleware(['auth']);
Route::post('tables/download-record', [EndpointController::class, 'downloadTableRecord'])->middleware(['auth']);

require __DIR__.'/auth.php';
