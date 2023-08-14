<?php

use App\Http\Controllers\ConfigureController;
use App\Http\Controllers\HomeController;
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

Route::resource('configure', ConfigureController::class)->only(['index', 'store']);

Route::middleware('api-configured')->group(function () {
    Route::get('/', HomeController::class)->name('home');
});
