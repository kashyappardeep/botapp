<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::namespace('\App\Http\Controllers')->group(function () {
    Route::post('/register', "UserController@register");
    Route::post('/claim', [UserController::class, 'claimDailyAmount']);
    Route::post('/investment', [UserController::class, 'invest']);
    Route::post('/transactions', [UserController::class, 'transactions']);
    Route::post('/tesk', [UserController::class, 'user_task']);
    Route::post('/task_claim', [UserController::class, 'task_claim']);
});
