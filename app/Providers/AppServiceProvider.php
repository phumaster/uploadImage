<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use App\FriendShip;
use Route;

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
            if($auth->check()) {
                $friendRequest = FriendShip::where(['to' => $auth->user()->id, 'accepted' => 0])->orderBy('id', 'DESC')->get();
                $view->with('friendRequest', $friendRequest);
            }
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
