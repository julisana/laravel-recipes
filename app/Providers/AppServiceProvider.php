<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

ini_set('xdebug.max_nesting_level', 3000);

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
