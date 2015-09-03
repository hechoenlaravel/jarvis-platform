<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('pageTitle')</title>
        <link href="{{ asset('/vendor/laravelAdmin/css/vendors.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/laravelAdmin/css/app.css') }}" rel="stylesheet">
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
                datablesLang: '//cdn.datatables.net/plug-ins/1.10.7/i18n/English.json'
            };
        </script>
        @if(config('app.locale') == 'es')
        <script>
            GLOBALS.datablesLang = '//cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json';
        </script>
        @endif()
    </head>
    <body class="login-page">
        @yield('content')
        <!-- Scripts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="{{ asset('/vendor/laravelAdmin/js/all.js') }}"></script>
    </body>
</html>
