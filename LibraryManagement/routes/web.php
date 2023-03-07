<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TypeBookController;
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



Route::resource('book', BookController::class);
Route::resource('type', TypeBookController::class);

Route::middleware('isLoggedin')->group(function () {
    Route::get("", [AdminController::class, 'index'])->name('dashboard');
    Route::get("logout", [AdminController::class, 'logout'])->name('logout');
});
Route::get('login', [AdminController::class, 'showLogin'])->name('login')->middleware('alreadyLoggedIn');
Route::post('login', [AdminController::class, 'login'])->name('login');
Route::get('page404', [AdminController::class, 'page404'])->name('page404');
