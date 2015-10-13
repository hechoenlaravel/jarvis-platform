<!DOCTYPE html>
<html lang="es" ng-app="JarvisPlatform">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('partials.meta')
    </head>
    <body class="skin-blue sidebar-mini">
        <div class="wrapper">
            @include('partials.nav')
            <aside class="main-sidebar">
                @include('partials.sidebar')
            </aside>
            <div class="content-wrapper">
                <section class="content-header">
                    @yield('content-header')
                </section>
                <section class="content">
                    @yield('content')
                </section>
            </div>
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    {{config('app.app_name')}} - <b>Version</b> {{config('app.version')}}
                </div>
                <strong>Copyright © {{date('Y')}}</strong>
            </footer>
        </div>
        @include('partials.footer_meta')
    </body>
</html>
