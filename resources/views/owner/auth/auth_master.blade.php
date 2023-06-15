<!doctype html>
<html lang="en">

@include('owner.auth.authHead')

<body class="light ">
    <div class="wrapper vh-100">
        <div class="row align-items-center h-100">

            @yield('content')

        </div>
    </div>

    @include('owner.auth.authScripts')
</body>

</html>
