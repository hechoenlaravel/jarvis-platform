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
        $menu->route('dashboard', 'Dashboard', [], 1, ['icon' => 'fa fa-dashboard'])->hideWhen(function(){
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
