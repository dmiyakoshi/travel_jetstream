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

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/', [PlanController::class, 'index'])
    ->name('root');

Route::resource('plans', PlanController::class)
    ->only(['create', 'store', 'edit', 'update', 'destory'])
    ->middleware('auth.companies');

Route::resource('plans', PlanController::class)
    ->only(['show']);

Route::resource('hotels', HotelController::class)
    ->only(['create', 'store', 'edit', 'update', 'destory'])
    ->middleware('auth.companies');

Route::resource('hotels', HotelController::class)
    ->only(['index', 'show']);


Route::resource('reservations', ReservationController::class)
    ->only(['create', 'store'])
    ->middleware('users');

Route::resource('reservations', ReservationController::class)
    ->only(['show', 'index', 'destory'])
    ->middleware('auth.comoanies, users');

Route::resource('reservations', ReservationController::class)
    ->except(['update', 'edit']);

Route::resource('plans.reservations', ReservationController::class)
    ->only(['create', 'destory'])
    ->middleware(['auth:users']);

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

require __DIR__ . '/auth.php';
