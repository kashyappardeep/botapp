<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\LevelController;

Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login']);
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/withdraw_request', [UsersController::class, 'withdraw_request'])->name('admin.withdraw_request');
        Route::resource('users', UsersController::class);
        Route::resource('Config', ConfigController::class);
        Route::resource('Level', LevelController::class);
    });
});
