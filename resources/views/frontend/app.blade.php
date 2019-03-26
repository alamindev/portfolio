<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Black+Ops+One|Chewy" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('frontend/css/app.css') }}" rel="stylesheet"> 
        @if(!empty($general->fav_icon))
              <link rel="shortcut icon" href="{{ asset('uploads/generals/'.$general->fav_icon) }}">
          @endif
</head>
<body>
    <div id="app"> 
         <vue-progress-bar></vue-progress-bar>
         <app-default></app-default>
    </div>
        <!-- Scripts -->
    <script src="{{ asset('frontend/js/app.js') }}" defer></script>
</body>
</html>
