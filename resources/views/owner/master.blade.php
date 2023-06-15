<!doctype html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
@include('owner.partials.head')

<body class="vertical light {{ LaravelLocalization::getCurrentLocaleDirection() }}">
    <div class="wrapper">

        @include('owner.partials.header')

        @include('owner.partials.sidebar')

        <main role="main" class="main-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>

    </div> <!-- .wrapper -->

    @include('owner.modals.mainModal')
    @include('owner.modals.deleteModal')
    @include('owner.partials.scripts')
</body>

</html>
