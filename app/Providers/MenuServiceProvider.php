<?php

namespace JarvisPlatform\Providers;

use MenuPing;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if(!MenuPing::instance('sidebar'))
        {
            MenuPing::create('sidebar', function ($menu) {
                $menu->enableOrdering();
                $menu->setPresenter('JarvisPlatform\Presenters\SidebarMenuPresenter');
            });
        }
        if(!MenuPing::instance('navbar'))
        {
            MenuPing::create('navbar', function ($menu) {
                $menu->setPresenter('Pingpong\Menus\Presenters\Bootstrap\NavbarPresenter');
            });
        }
        if(!MenuPing::instance('userMenu'))
        {
            MenuPing::create('userMenu', function ($menu) {
                $menu->setPresenter('Pingpong\Menus\Presenters\Bootstrap\NavbarPresenter');
            });
        }
        if(!MenuPing::instance('config'))
        {
            MenuPing::create('config', function ($menu) {
                $menu->enableOrdering();
                $menu->setPresenter('JarvisPlatform\Presenters\SidebarMenuPresenter');
            });
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
