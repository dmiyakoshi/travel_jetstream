<?php

use App\Http\Controllers\CsvImportController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StripePaymentsController;
use Illuminate\Support\Facades\Route;
// use App\Mylib\Myfunction;

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

Route::get('/', [PlanController::class, 'index'])
    ->name('root');

Route::resource('plans', PlanController::class)
    ->only(['destroy', 'create', 'store', 'edit', 'update'])
    ->middleware('auth:companies')
    ->whereNumber('id');

Route::resource('plans', PlanController::class)
    ->only(['show'])
    ->whereNumber('id');

Route::resource('hotels', HotelController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->middleware('auth:companies')
    ->whereNumber('id');

Route::resource('hotels', HotelController::class)
    ->only(['index', 'show'])
    ->whereNumber('id');

Route::resource('plans.reservations', ReservationController::class)
    ->only(['create', 'store'])
    ->middleware(['auth:users'])
    ->whereNumber('id');

Route::post('reservations/{reservation}', [ReservationController::class, 'destory'])
    ->middleware(['auth:users', 'auth:companies'])
    ->whereNumber('id')
    ->name('reservations.destory');

// editをどうするか未定 変えるとしたら予約日？ 支払いがすんでいたらどうする？
// Route::resource('plans.reservations', ReservationController::class)
//     ->except(['show', 'edit', 'update'])
//     ->whereNumber('id');

Route::get('/payment/create/{reservation}', [StripePaymentsController::class, 'create'])
    ->name('payment.create')
    ->middleware('auth:users')
    ->whereNumber('id');

Route::post('/payment/charge/{reservation}', [StripePaymentsController::class, 'charge'])
    ->name('payment.charge')
    ->middleware('auth:users')
    ->whereNumber('id');

// Route::get('/payment/complete', [StripePaymentsController::class, 'complete'])
//     ->name('payment.complete');

Route::get('/payment/complete', [StripePaymentsController::class, 'complete'])
    ->name('payment.complete')
    ->middleware('auth:users');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/import-csv-prefecture', [CsvImportController::class, "showPrefecture"]);
Route::post('/import-csv-prefecture', [CsvImportController::class, 'importPrefecture']);
Route::get('/import-csv-region', [CsvImportController::class, "showRegion"]);
Route::post('/import-csv-region',  [CsvImportController::class, "importRegion"]);

// test
// Route::get('test', function () {
//     $myfun = new Myfunction;
//     return $myfun->renderCalender();
// });
// Route::get('helper', function() {
//     return hello();
// });

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
