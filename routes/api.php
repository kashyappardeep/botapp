<?php

use Illuminate\Support\Facades\Route;

Route::namespace('\App\Http\Controllers\Api')->group(function () {
    Route::post('/register', "UserController@register");
    Route::post('/claim', 'UserController@claimDailyAmount');
    Route::post('/confirm-payment', 'UserController@invest');
    Route::post('/order_details', 'UserController@order_details');
    Route::post('/transactions', 'UserController@transactions');
    Route::post('/wallet_histroy', 'UserController@wallet_histroy');
    Route::post('/task', 'UserController@user_task');
    Route::post('/task_claim', 'UserController@task_claim');
    Route::post('/withdrow', 'UserController@withdrow');
    Route::post('/RequestLinkVerify', 'UserController@RequestLinkVerify');
    Route::get('/LinkVerify', 'UserController@LinkVerify');
});
