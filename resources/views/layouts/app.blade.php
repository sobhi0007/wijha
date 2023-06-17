<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{app()->getLocale()=='en'?'ltr':'rtl'}}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
       
      
        @if (Lang::locale() == 'ar')
    
        <!-- ar bootstrap css styles -->
        <link rel="stylesheet" href="{{asset('home-assets/rtl/css/bootstrap.rtl.min.css')}}"  crossorigin="anonymous">

        <!-- swiper -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

        <!-- fontawesome icons -->
        <link href="{{asset('home-assets/rtl/fontawesome/css/fontawesome.css')}}" rel="stylesheet">
        <link href="{{asset('home-assets/rtl/fontawesome/css/brands.css')}}" rel="stylesheet">
        <link href="{{asset('home-assets/rtl/fontawesome/css/solid.css')}}" rel="stylesheet">
        <!-- css style -->
        <link rel="stylesheet" href="{{asset('home-assets/rtl/css/style.css')}}">
    @else
    
        <!-- bootstrap css styles -->
        <link rel="stylesheet" href="{{asset('home-assets/ltr/css/bootstrap.min.css')}}">
        <!-- swiper -->
        <link rel="stylesheet" href="{{asset('home-assets/ltr/css/swiper-bundle.min.css')}}" />
        <!-- css style -->
        <link rel="stylesheet" href="{{asset('home-assets/ltr/css/style.css')}}">
        <!-- fontawesome icons -->
        <link href="{{asset('home-assets/rtl/fontawesome/css/fontawesome.css')}}" rel="stylesheet">
        <link href="{{asset('home-assets/rtl/fontawesome/css/brands.css')}}" rel="stylesheet">
        <link href="{{asset('home-assets/rtl/fontawesome/css/solid.css')}}" rel="stylesheet">
         <!-- css style -->
        <link rel="stylesheet" href="{{asset('home-assets/ltr/css/style.css')}}">
    @endif
    @livewireStyles
    @livewireScripts
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

          @if (Lang::locale()=='ar')
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
                integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
                crossorigin="anonymous">
            </script>
            <script src="{{asset('home-assets/rtl/js/bootstrap.min.js')}}"></script>
             <script src="{{asset('home-assets/rtl/js/bootstrap.bundle.min.js')}}"></script>
            <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>

            <!-- calender script -->
            <script src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT"
                crossorigin="anonymous">
            </script>
            <script src="{{asset('home-assets/rtl/theme/js/t-datepicker.min.js')}}"></script>
            <script src="{{asset('home-assets/rtl/js/ar-script.js')}}"></script>
        @else

            <script src="{{asset('home-assets/ltr/js/popper.min.js')}}"></script>
            <script src="{{asset('home-assets/ltr/js/bootstrap.min.js')}}"></script>
            <script src="{{asset('home-assets/ltr/js/swiper-element-bundle.min.js')}}"></script>
            {{-- <script src="{{asset('home-assets/ltr/js/bootstrap.bundle.min.js')}}"></script> --}}
            <!-- calender script -->
            <script src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT"
                crossorigin="anonymous"></script>
            <script src="{{asset('home-assets/ltr/theme/js/t-datepicker.min.js')}}"></script>

            <script src="{{asset('home-assets/ltr/js/en-script.js')}}"></script>
        @endif
    </body>
</html>
