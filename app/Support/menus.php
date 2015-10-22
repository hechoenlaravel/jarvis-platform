<?php

MenuPing::create('sidebar', function ($menu) {
    $menu->enableOrdering();
    if(Auth::check()) {
        $menu->route('dashboard', 'Dashboard', [], 1, ['icon' => 'fa fa-dashboard']);
        if (Auth::user()->ability('administrator', 'user-create,user-edit,user-delete,user-activate')) {
            $menu->route('users.index', 'Usuarios', [], 2, ['icon' => 'fa fa-users', 'active' => function(){
                $request = app('Illuminate\Http\Request');
                return $request->is('users*');
            }]);
        }
        $menu->dropdown('Configuraciones', function($sub){
            if (Auth::user()->ability('administrator', 'user-configuration')) {
                $sub->route('users.config', 'Usuarios', [], 1, ['active' => function(){
                    $request = app('Illuminate\Http\Request');
                    return $request->is('config/users*');
                }]);
            }
            if (Auth::user()->ability('administrator', 'create-role,edit-role,delete-role,admin-permissions')) {
                $sub->route('roles.index', 'Roles y Permisos', [], 2, ['active' => function(){
                    $request = app('Illuminate\Http\Request');
                    return $request->is('roles*');
                }]);
            }
        }, 3, ['icon' => 'fa fa-lock']);
    }
    $menu->setPresenter('JarvisPlatform\Presenters\SidebarMenuPresenter');
});

MenuPing::create('navbar', function ($menu) {
    $menu->setPresenter('Pingpong\Menus\Presenters\Bootstrap\NavbarPresenter');
});

MenuPing::create('userMenu', function ($menu) {
    if(Auth::check()){
        $menu->dropdown(Auth::user()->name, function ($sub) {
            $sub->url('me/edit', 'Editar Perfil', ['icon' => 'fa fa-user']);
            $sub->divider();
            $sub->url('auth/logout', 'Cerrar Sesión', ['icon' => 'fa fa-sign-out']);
        });
    }
    $menu->setPresenter('Pingpong\Menus\Presenters\Bootstrap\NavbarPresenter');
});