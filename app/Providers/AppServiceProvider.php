<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use App\FriendShip;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Guard $auth)
    {
        view()->composer('*', function($view) use ($auth){
            $friendRequest = FriendShip::where('to', '=', $auth->user()->id)->orderBy('id', 'DESC')->get();
            $view->with('friendRequest', $friendRequest);
        });
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
