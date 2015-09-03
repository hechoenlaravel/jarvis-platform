<header class="main-header">
    <a href="{{url('backend/home')}}" class="logo">
        {{config('laravel-admin.appName')}}
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @if (!Auth::guest())
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="//{{'www.gravatar.com/avatar/'.md5(Auth::user()->email)}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="//{{'www.gravatar.com/avatar/'.md5(Auth::user()->email)}}" class="img-circle" alt="User Image">
                            <p>
                                {{ Auth::user()->name }}
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('LaravelAdminUpdateMe') }}" class="btn btn-default btn-flat">{{trans('LaravelAdmin::laravel-admin.editMyProfile')}}</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('LaravelAdminLogout') }}" class="btn btn-default btn-flat">{{trans('LaravelAdmin::laravel-admin.LogoutText')}}</a>
                            </div>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </nav>
</header>