<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        DB::listen(function ($query) {
            Log::info('Query Time: ' . $query->time . 'ms');
            Log::info('Query: ' . $query->sql);
            Log::info('Bindings: ' . json_encode($query->bindings));
        });
    }
}
