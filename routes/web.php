<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VerifyController;
<<<<<<< HEAD
=======
use App\Http\Controllers\Admin\DailyTaskController;
use App\Http\Controllers\Admin\TaskUserlist;
>>>>>>> 9e6cd4e14bc9cf82a6cd2845d47a40224bd14bba
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', [AdminController::class, 'showLoginForm'])->name('login');
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login']);
    // Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {

        Route::get('/withdraw_request', [UsersController::class, 'withdraw_request'])->name('admin.withdraw_request');
        Route::post('status_change/{id}', [UsersController::class, 'updateStatus'])->name('admin.status_change');
        Route::post('reject_Status/{id}', [UsersController::class, 'rejectStatus'])->name('admin.reject_Status');
        Route::get('user_investment/{id}', [UsersController::class, 'user_investment'])->name('admin.user_investment');

        Route::get('/contact_request', [UsersController::class, 'contact'])->name('admin.contact_request');
        Route::get('ShowcontacttStatus/{id}', [UsersController::class, 'ShowcontacttStatus'])->name('admin.ShowcontacttStatus');

        Route::put('contact_change/{id}', [UsersController::class, 'updatecontacttStatus'])->name('admin.contact_status_change');
        Route::post('contact_Status/{id}', [UsersController::class, 'contactrejectStatus'])->name('admin.contact_reject_Status');



        Route::get('/investment_request', [UsersController::class, 'investment_request'])->name('admin.investment_request');
        Route::post('invist_status_change/{id}', [UsersController::class, 'updateInvestmentStatus'])->name('admin.invist_status_change');
        Route::post('invest_reject_Status/{id}', [UsersController::class, 'investrejectStatus'])->name('admin.invest_reject_Status');
        Route::post('accept_TaskUserlist/{id}', [TaskUserlist::class, 'accept_TaskUserlist'])->name('admin.accept_TaskUserlist');

        Route::resource('dashboard', DashboardController::class);
        Route::resource('users', UsersController::class);
        Route::resource('Config', ConfigController::class);
        Route::resource('Level', LevelController::class);
        Route::resource('DailyTasks', DailyTaskController::class);
        Route::resource('TaskUserlist', TaskUserlist::class);



        Route::get('/user_address', [AddressController::class, 'user_address'])->name('admin.user_address');
        Route::put('address/{id}', [AddressController::class, 'update'])->name('address.address');
        Route::put('verify/{id}', [VerifyController::class, 'update'])->name('verify.verify');

        Route::resource('address', AddressController::class);
        Route::resource('verify', VerifyController::class);




        Route::post('/logout', function () {
            Auth::logout();
            return redirect('admin/login');
        })->name('logout');

        // Route::post('invist_status_change/{id}', [UsersController::class, 'updateInvestmentStatus'])->name('admin.invist_status_change');
        // Route::post('invest_reject_Status/{id}', [UsersController::class, 'investrejectStatus'])->name('admin.invest_reject_Status');

    });
});
