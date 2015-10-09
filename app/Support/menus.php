<?php

MenuPing::create('sidebar', function ($menu) {
    if(Auth::check()) {
        $menu->route('dashboard', 'Dashboard', [], 0, ['icon' => 'fa fa-dashboard']);
        if (Auth::user()->ability('administrator', 'user-create,user-edit,user-delete,user-activate')) {
            $menu->route('users.index', 'Usuarios', [], 1, ['icon' => 'fa fa-users']);
        }
    }
    $menu->setPresenter('JarvisPlatform\Presenters\SidebarMenuPresenter');
});

MenuPing::create('navbar', function ($menu) {
    $menu->setPresenter('Pingpong\Menus\Presenters\Bootstrap\NavbarPresenter');
});

MenuPing::create('userMenu', function ($menu) {
    if(Auth::check()){
        $menu->dropdown(Auth::user()->name, function ($sub) {
            $sub->url('#', 'Editar Perfil', ['icon' => 'fa fa-user']);
            $sub->divider();
            $sub->url('auth/logout', 'Cerrar Sesión', ['icon' => 'fa fa-sign-out']);
        });
    }
    $menu->setPresenter('Pingpong\Menus\Presenters\Bootstrap\NavbarPresenter');
});