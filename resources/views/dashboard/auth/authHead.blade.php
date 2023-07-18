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
    <title>{{ __('lang.admin_login_title') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset("assets$lang") }}/css/simplebar.css">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- App favicon -->
    <link rel="shortcut icon"  href="{{ asset('assets/images/logo.png') }}">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset("assets$lang") }}/css/feather.css">
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
</head>
