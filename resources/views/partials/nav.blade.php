<header class="main-header">
    <a href="{{url('dashboard')}}" class="logo">
        <span class="logo-mini">{{substr(config('app.app_name'), 0, 3)}}</span>
        <span class="logo-lg">{{config('app.app_name')}}</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Ver Menu</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @include('jarvisPlatform::notifications.navbar-notifications')
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{Auth::user()->getAvatarImageUrl()}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{Auth::user()->getAvatarImageUrl()}}" class="img-circle" alt="User Image">
                            <p>
                                {{Auth::user()->name}}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{url('me/edit')}}" class="btn btn-default btn-flat">Editar Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{url('auth/logout')}}" class="btn btn-default btn-flat">Salida Segura</a>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>