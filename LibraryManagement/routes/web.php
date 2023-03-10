<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanCardController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TypeBookController;
use Illuminate\Support\Facades\Route;

Route::middleware('isStaffLoggedin')->group(function() {
    Route::get('home', [StaffController::class, 'index'])->name('home');
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
    Route::group(['prefix' => 'staff', 'as' => 'staff.'], function () {
        Route::get('change-password', [AuthController::class, 'changePassword'])->name('change-password');
        Route::post('save-password', [AuthController::class, 'saveChangePassword'])->name('save-password');
    });
});

Route::middleware('isAdminLoggedin')->group(function () {
    Route::get('', [AdminController::class, 'index'])->name('dashboard');
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('staff-management', [AdminController::class, 'staffManagement'])->name('staff-management');
        Route::get('add-staff', [AdminController::class, 'addStaff'])->name('add-staff');
        Route::post('add-staff', [AdminController::class, 'saveAddStaff'])->name('add-staff');
        Route::post('edit-staff', [AdminController::class, 'editStaff'])->name('edit-staff');
        Route::put('edit-staff', [AdminController::class, 'saveEditStaff'])->name('edit-staff');
        Route::delete('{staff}/delete-staff', [AdminController::class, 'deleteStaff'])->name('delete-staff');
        Route::get('statistical', [AdminController::class, 'statisticalAllBook'])->name('statistical');
        Route::get('change-password', [AuthController::class, 'changePassword'])->name('change-password');
        Route::post('save-password', [AuthController::class, 'saveChangePassword'])->name('save-password');
    });
});

Route::get('login', [AuthController::class, 'showLogin'])->name('login')->middleware('alreadyLoggedIn');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('page404', [AuthController::class, 'page404'])->name('page404');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
