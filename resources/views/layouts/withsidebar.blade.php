<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('pageTitle')</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <link href="{{ asset('css/all.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jarvis-platform.css') }}" rel="stylesheet">
        @yield('styles')
        <!-- Fonts -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            var GLOBALS = {
                site_url: '{{url()}}',
                datablesLang: '//cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json'
            };
        </script>
    </head>
    <body class="skin-blue sidebar-mini">
        <div class="wrapper">
            @include('partials.nav')
            <aside class="main-sidebar">
                @include('partials.sidebar')
            </aside>
            <div class="content-wrapper">
                <section class="content-header">
                    @yield('content')
                </section>
            </div>
        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                {{config('app.app_name')}} - <b>Version</b> {{config('app.version')}}
            </div>
        </footer>
        <!-- Scripts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="{{ asset('/js/all.js') }}"></script>
        @yield('scripts')
    </body>
</html>
