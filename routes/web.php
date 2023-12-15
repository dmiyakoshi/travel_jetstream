<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ReservationController;
use App\Models\Hotel;
use App\Models\Reservation;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// 今回は使わない
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::resource('hotels', HotelController::class)
    ->only(['create', 'store', 'edit', 'update', 'destory'])
    ->middleware('auth.companies');


Route::resource('plans', PlanController::class)
    ->only(['create', 'store', 'edit', 'update', 'destory'])
    ->middleware('auth.companies');


Route::resource('reservations', ReservationController::class)
    ->only(['create', 'store'])
    ->middleware('users');

Route::resource('reservations', ReservationController::class)
    ->only(['show', 'destory'])
    ->middleware('auth.comoanies, users');

Route::resource('reservations', ReservationController::class)
    ->except(['index', 'edit']);

// Route::resource('hotels', HotelController::class)
//     ->only(['show', 'index'])
//     ->middleware('auth.companies , users');

require __DIR__ . '/auth.php';
