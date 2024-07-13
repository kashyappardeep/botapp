<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\Api\UserController;

Route::namespace('\App\Http\Controllers\Api')->group(function () {
    Route::post('/register', "UserController@register");
    Route::post('/claim', 'UserController@claimDailyAmount');
    Route::post('/confirm-payment', 'UserController@invest');
    Route::post('/order_details', 'UserController@order_details');
    Route::post('/transactions', 'UserController@transactions');
});
