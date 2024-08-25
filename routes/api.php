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
    Route::post('/Bost_history', 'UserController@Bost_history');
    Route::post('/withdrow', 'UserController@withdrow');
    Route::post('/RequestLinkVerify', 'UserController@RequestLinkVerify');
    Route::get('/LinkVerify', 'UserController@LinkVerify');
    Route::get('/earn_by_facebook', 'UserController@earn_by_facebook');
    Route::post('/RequestFbPopup', 'UserController@RequestFbPopup');
<<<<<<< HEAD
=======
    Route::post('/DailyTaskUserlist', 'UserController@DailyTaskUserlist');
    Route::post('/showusertaskrecord', 'UserController@showusertaskrecord');
    Route::get('/DailyTask', 'UserController@DailyTask');
>>>>>>> 9e6cd4e14bc9cf82a6cd2845d47a40224bd14bba
});
