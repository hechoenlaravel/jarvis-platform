<header class="main-header">
    <a href="{{url('dashboard')}}" class="logo">
        {{config('app.app_name')}}
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        {!! MenuPing::render('navbar') !!}
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            @include('jarvisPlatform::notifications.navbar-notifications')
            {!! MenuPing::render('userMenu') !!}
        </div>
    </nav>
</header>