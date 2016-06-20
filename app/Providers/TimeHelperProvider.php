<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TimeHelperProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        require base_path().'/app/Helpers/TimeHelper.php';
    }
}
