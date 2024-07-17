<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::namespace('\App\Http\Controllers')->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/claim', [UserController::class, 'claimDailyAmount']);
    Route::post('/investment', [UserController::class, 'invest']);
    Route::post('/transactions', [UserController::class, 'transactions']);
    Route::post('/task', [UserController::class, 'user_task']);
    Route::post('/task_claim', [UserController::class, 'task_claim']);
    Route::post('/confirm-payment', [UserController::class, 'invest']);
});
