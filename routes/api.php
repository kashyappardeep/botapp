<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::namespace('\App\Http\Controllers')->group(function () {
    Route::post('/register', "UserController@register");
    Route::post('/claim', [UserController::class, 'claimDailyAmount']);
    Route::post('/investment', [UserController::class, 'invest']);
});
