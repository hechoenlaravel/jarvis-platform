<?php

namespace JarvisPlatform\Providers;

use Auth;
use MenuPing;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $menu = MenuPing::instance('sidebar');
        $menu->route('home', 'Home', [], 1, ['icon' => 'fa fa-home'])->hideWhen(function(){
            return Auth::guest();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
