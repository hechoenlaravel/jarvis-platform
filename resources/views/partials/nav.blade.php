<header class="main-header">
    <a href="{{url('dashboard')}}" class="logo">
        {{config('app.app_name')}}
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        {!! MenuPing::render('navbar') !!}
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-success">{{$notifications['count']}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Tiene {{$notifications['count']}} notificación(es)</li>
                        <li>
                            <ul class="menu">
                                @foreach($notifications['notifications'] as $notification)
                                    <li>
                                        <a href="{{$notification->getLink()}}">
                                            <i class="fa fa-bell"></i> <span class="text-{{ $notification->type }}">{{$notification->message}}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        <li>
                        <li class="footer"><a href="#">Ver Todas</a></li>
                    </ul>
                </li>
            </ul>
            {!! MenuPing::render('userMenu') !!}
        </div>
    </nav>
</header>