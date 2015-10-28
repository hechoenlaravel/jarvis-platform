<?php

namespace JarvisPlatform\Providers;

use Illuminate\Support\ServiceProvider;
use Hechoenlaravel\JarvisFoundation\Notifications\ViewComposers\InAppNotificationsViewComposer;

class ViewComposersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.nav', InAppNotificationsViewComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
