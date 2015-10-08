<?php

MenuPing::make('sidebar', function($menu)
{
    $menu->route('dashboard', 'Dashboard', [], 0, ['icon' => 'fa fa-dashboard']);
    $menu->setPresenter('JarvisPlatform\Presenters\SidebarMenuPresenter');
});

MenuPing::make('navbar', function($menu)
{
    $menu->setPresenter('Pingpong\Menus\Presenters\Bootstrap\NavbarPresenter');
});

MenuPing::make('userMenu', function($menu)
{
    if(!Auth::guest()){
        $menu->dropdown(Auth::user()->name, function ($sub) {
            $sub->url('#', 'Editar Perfil', ['icon' => 'fa fa-user']);
            $sub->divider();
            $sub->url('auth/logout', 'Cerrar Sesión', ['icon' => 'fa fa-sign-out']);
        });
    }
    $menu->setPresenter('Pingpong\Menus\Presenters\Bootstrap\NavbarPresenter');
});
