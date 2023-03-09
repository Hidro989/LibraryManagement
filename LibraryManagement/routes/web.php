<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanCardController;
use App\Http\Controllers\ReaderController;
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
Route::resource('book', BookController::class)->except(['edit', 'show']);
Route::controller(BookController::class)->group(function () {
    Route::get('/book/{isbn}', 'edit');
});

Route::resource('type', TypeBookController::class)->except(['edit', 'show']);

Route::controller(TypeBookController::class)->group(function () {
    Route::get('/type/{id}', 'edit');
});

Route::resource('reader', ReaderController::class)->except(['edit', 'show']);
Route::controller(ReaderController::class)->group(function () {
    Route::get('/reader/{cmnd}', 'edit');
});
Route::resource('loancard', LoanCardController::class)->except(['edit', 'show']);
Route::controller(LoanCardController::class)->group(function () {
    Route::get('/loancard/{id}', 'edit');
    Route::put('/loancard/return/{id}', 'returnBooks');
});



Route::view('/404', 'error.page404');

Route::middleware('isLoggedin')->group(function () {
    Route::get("", [AdminController::class, 'index'])->name('dashboard');
    Route::get("logout", [AdminController::class, 'logout'])->name('logout');
});
Route::get('login', [AdminController::class, 'showLogin'])->name('login')->middleware('alreadyLoggedIn');
Route::post('login', [AdminController::class, 'login'])->name('login');
Route::get('page404', [AdminController::class, 'page404'])->name('page404');
