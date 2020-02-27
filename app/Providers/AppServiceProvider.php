<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //To accommodate MariaDB and older versions of MySQL
        //https://laravel-news.com/laravel-5-4-key-too-long-error
        Schema::defaultStringLength( 191 );
    }
}
