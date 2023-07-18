<?php
if (LaravelLocalization::getCurrentLocale() == 'ar') {
    $lang = '-rtl';
} else {
    $lang = '';
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- fontawesome icons -->
     <link href="{{asset('home-assets/rtl/fontawesome/css/fontawesome.css')}}" rel="stylesheet">
     <link href="{{asset('home-assets/rtl/fontawesome/css/brands.css')}}" rel="stylesheet">
     <link href="{{asset('home-assets/rtl/fontawesome/css/solid.css')}}" rel="stylesheet">
    <!-- App favicon -->
    <link rel="shortcut icon"  href="{{ asset('assets/images/logo.png') }}">
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset("assets$lang") }}/css/simplebar.css">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset("assets$lang") }}/css/feather.css">
    <link rel="stylesheet" href="{{ asset("assets$lang") }}/css/select2.css">
    <link rel="stylesheet" href="{{ asset("assets$lang") }}/css/dropzone.css">
    <link rel="stylesheet" href="{{ asset("assets$lang") }}/css/uppy.min.css">
    <link rel="stylesheet" href="{{ asset("assets$lang") }}/css/jquery.steps.css">
    <link rel="stylesheet" href="{{ asset("assets$lang") }}/css/jquery.timepicker.css">
    <link rel="stylesheet" href="{{ asset("assets$lang") }}/css/quill.snow.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset("assets$lang") }}/css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset("assets$lang") }}/css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="{{ asset("assets$lang") }}/css/app-dark.css" id="darkTheme" disabled>
    <!-- Arabic Font If Needed -->
    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap"
            rel="stylesheet">
        <style>
            * {
                font-family: 'Tajawal', sans-serif;
            }
        </style>
    @endif
    @stack('styles')
    <style>
        .row {
            /* padding-right: 15px !important;
            padding-left: 15px !important; */
        }

        .font-size-14 {
            font-size: 14px !important;
        }

        .font-size-11 {
            font-size: 11px !important;
        }

        .form-label {
            color: blue;
        }

        .form-group {
            margin-bottom: 5px !important;
        }

        .error {
            border: 1px solid #dc3545 !important;
        }
    </style>

    <script src="https://cdn.tiny.cloud/1/w4lsr7es1xjc9dna5awr0cqz8yhy13bksz36co4fm9jiikeu/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
@livewireStyles
        @livewireScripts
</head>
