<?php namespace Modules\Users\Providers;

use Auth;
use MenuPing;
use Modules\Users\Entities\Role;
use Modules\Users\Entities\User;
use Illuminate\Support\ServiceProvider;
use Modules\Users\Observers\RoleObserver;
use Modules\Users\Observers\UserObserver;

class UsersServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerTranslations();
        $this->registerViews();
        \Entrust::routeNeedsRoleOrPermission('users*', ['administrador-del-sistema'],
            ['user-create', 'user-edit', 'user-delete', 'user-activate'], null, false);
        \Entrust::routeNeedsRoleOrPermission('config/users*', ['administrador-del-sistema'],
            ['user-configuration'], null, false);
        \Entrust::routeNeedsRoleOrPermission('roles*', ['administrador-del-sistema'],
            ['create-role', 'edit-role', 'delete-role', 'admin-permissions'], null, false);
        User::observe(new UserObserver());
        Role::observe(new RoleObserver());
        $this->setMenu();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            \Modules\Users\Console\CreateEntities::class,
            \Modules\Users\Console\GenerateAdmin::class,
            \Modules\Users\Console\GenerateDefaultRoleAndPerms::class,
        ]);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('users.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php', 'users'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/users');

        $sourcePath = __DIR__ . '/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom([$viewPath, $sourcePath], 'users');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/users');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'users');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'users');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    protected function setMenu()
    {
        $menu = MenuPing::instance('sidebar');
        $menu->route('users.index', 'Usuarios', [], 2, ['icon' => 'fa fa-users', 'active' => function(){
            $request = app('Illuminate\Http\Request');
            return $request->is('users*');
        }])->hideWhen(function(){
            if(Auth::user()->ability('administrator', 'user-create,user-edit,user-delete,user-activate'))
            {
                return false;
            }
            return true;
        });
        $menuConfig = MenuPing::instance('config');
        $menuConfig->whereTitle('Configuración', function($sub){
            $sub->route('users.config', 'Usuarios', [], 1, ['active' => function(){
                $request = app('Illuminate\Http\Request');
                return $request->is('config/users*');
            }])->hideWhen(function(){
                if(Auth::user()->ability('administrator', 'user-configuration')){
                    return false;
                }
                return true;
            });
            $sub->route('roles.index', 'Roles y Permisos', [], 2, ['active' => function(){
                $request = app('Illuminate\Http\Request');
                return $request->is('roles*');
            }])->hideWhen(function(){
                if(Auth::user()->ability('administrator', 'create-role,edit-role,delete-role,admin-permissions')){
                    return false;
                }
                return true;
            });
        });
        $menuUser = MenuPing::instance('userMenu');
        $menuUser->dropdown('Menu de Usuario', function ($sub) {
            $sub->url('me/edit', 'Editar Perfil', ['icon' => 'fa fa-user']);
            $sub->divider();
            $sub->url('auth/logout', 'Cerrar Sesión', ['icon' => 'fa fa-sign-out']);
        })->hideWhen(function(){
            return Auth::guest();
        });
    }

}
