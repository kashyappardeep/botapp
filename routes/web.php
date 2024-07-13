<?php

use App\Http\Controllers\Admin\ClaimHistoryController;
use App\Http\Controllers\Admin\ConfigController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardControlle;
use App\Http\Controllers\Admin\InvestmentHistoryController;
use App\Http\Controllers\Admin\UserController;

Route::resource('dashboard', DashboardControlle::class);
Route::resource('Userlist', UserController::class);
Route::resource('claim_history', ClaimHistoryController::class);
Route::resource('Config', ConfigController::class);
Route::resource('InvestmentHistory', InvestmentHistoryController::class);
