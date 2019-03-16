
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>Admin:- @yield('title')</title>
                <!-- Fonts -->
            <link rel="dns-prefetch" href="//fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
            <!-- Styles -->
            <link href="{{ asset('backend/css/app.css') }}" rel="stylesheet">
            <link href="{{ asset('backend/css/theme.css') }}" rel="stylesheet">
            <link href="{{ asset('backend/css/main.css') }}" rel="stylesheet">
            <link href="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
            @yield('styles')
            <!-- App Favicon -->
          @if(!empty($general->fav_icon))
              <link rel="shortcut icon" href="{{ asset('uploads/generals/'.$general->fav_icon) }}">
          @endif
    </head>

    <body class="fixed-left">
            @if(Route::currentRouteName() !== 'admin.login' && Route::currentRouteName() !== 'admin.password.request' && Route::currentRouteName() !== 'admin.password.reset')
            <!-- Begin page -->
            <div id="wrapper" >
                <div id="app">
                    @include('backend/_includes/header')
                    @include('backend/_includes/left-sidebar')
                    <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                    <div class="content-page">
                        <!-- Start content -->
                        <div class="content">
                            <div class="container-fluid">
                                @include('backend/_includes/breadcrumb')
                                @yield('main-content')
                            </div>
                        </div>
                    </div>
                    @include('backend/_includes/right-sidebar')
                    @include('backend/_includes/footer')
                </div>
            </div>
            @else
            <div id="app">
                    @yield('main-content')
            </div>
            @endif
    <!-- Scripts -->
    <script>
            var resizefunc = [];
    </script>
    <script type="text/javascript" src="{{ asset('backend/js/app.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}" defer></script> 
    <script src="{{ asset('backend/js/vendor.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/parsleyjs/parsley.min.js') }}" defer></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8" defer></script>
    @include('sweetalert::alert')
    @yield('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/custom.js') }}"></script>

</body>
</html>
