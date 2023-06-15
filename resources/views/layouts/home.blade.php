<!DOCTYPE html>
<html lang="{{Lang::locale()}}" dir="{{Lang::locale() == 'ar'? 'rtl':'ltr'}}">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wijha</title>
    <link rel="icon" href="{{asset('assets/images/logo.png')}}">
     <!-- Moyasar Scripts -->
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.7.3/moyasar.css" />
    <script src="https://polyfill.io/v3/polyfill.min.js?features=fetch"></script>
    <script src="https://cdn.moyasar.com/mpf/1.7.3/moyasar.js"></script>

    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">

    @if (Lang::locale() == 'ar')
    
    <!-- ar bootstrap css styles -->
    <link rel="stylesheet" href="{{asset('home-assets/rtl/css/bootstrap.rtl.min.css')}}"  crossorigin="anonymous">

    <!-- swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <!-- fontawesome icons -->
    <link href="{{asset('home-assets/rtl/fontawesome/css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('home-assets/rtl/fontawesome/css/brands.css')}}" rel="stylesheet">
    <link href="{{asset('home-assets/rtl/fontawesome/css/solid.css')}}" rel="stylesheet">
    <!-- animation style -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- animation script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- css style -->
    <link rel="stylesheet" href="{{asset('home-assets/rtl/css/style.css')}}">
    <style>
        .mySwiper {
            overflow: initial;
        }

        .owl-carousel,
        .bx-wrapper { direction: ltr; }
        .owl-carousel .owl-item { direction: rtl; }
    </style>
    <!-- calender -->
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="{{asset('home-assets/rtl/theme/css/t-datepicker.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('home-assets/rtl/theme/css/themes/t-datepicker-orange.css')}}" rel="stylesheet" type="text/css">

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
    <!-- animation style -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- animation script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- calender -->
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="{{asset('home-assets/ltr/theme/css/t-datepicker.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('home-assets/ltr/theme/css/themes/t-datepicker-orange.css')}}" rel="stylesheet" type="text/css">
    <!-- css style -->
    <link rel="stylesheet" href="{{asset('home-assets/ltr/css/style.css')}}">
    @endif
    @livewireStyles
    @livewireScripts

</head>

<body>
    <div id="load" class="d-flex justify-content-center align-items-center ">
        <img class="position-absolute" src="{{asset('assets/images/logo.png')}}" alt="your logo" width="50">
        <div class="spinner-border" style="width: 6rem;height: 6rem;" role="status">
        </div>
    </div>



    <!-- navbar -->
    <div id="contents">
        <nav
            class="navbar navbar-expand-lg  sticky-top navbar-light bg-nav-transparent bg-custom-transparent border-bottom-gray">
            <div class="container-fluid px-md-4 ">
                <a class="navbar-brand " href="/">
                    <img src="{{asset('assets/images/logo.png')}}" alt="logo" width="70" height="55">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto text-left">

                        @foreach ($categories as $category)


                        <li class="nav-item dropdown  mx-3">
                            <a class="nav-link line fs-7  active  " href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{$category->name}}
                            </a>

                        </li>
                        @endforeach
                        <li class="nav-item dropdown  mx-3"><a class="nav-link line fs-7  active  " href="{{route('faq')}}">{{__('lang.faqs')}}</a> </li>
                        <li class="nav-item dropdown  mx-3"><a class="nav-link line fs-7  active  " href="{{route('message.index')}}">{{__('lang.contact_us')}}</a> </li>
                    </ul>
                    <ul class="navbar-nav  ">
                        @guest
                        <li class="nav-item dropdown  mx-3">
                            <a type="button" class="fs-7 nav-link line text-dark text-decoration-none"
                                data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                {{__('lang.home_login_title')}} | {{__('lang.home_sginup_title')}}
                            </a>
                        </li>
                        @endguest

                        @auth
                        <li class="nav-item   m-3">{{Auth::user()->name}}</li>
                        @endauth
                        <li class="nav-item dropdown  mx-3">
                            <div class="dropdown">

                                <?php
                            if (Lang::locale() == 'en') {
                                $flag = 'en.png';
                                $language =  'English';
                            } else {
                                $flag = 'ar.png';
                                $language =  'العربيه';
                            }
                        ?>


                                <a href="#" class=" fs-7 nav-link line text-dark text-decoration-none"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img id="header-lang-img2" src="{{ asset('assets') }}/images/languages/{{$flag}}"
                                        alt="Header Language" class="rounded" height="22"> {{$language}}
                                </a>
                                <ul class="dropdown-menu dropdown-position ">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <?php
                                    if ($localeCode == 'en') {
                                        $flag = 'en.png';
                                        $language =  'English';
                                    } else {
                                        $flag = 'ar.png';
                                        $language =  'العربيه';
                                    }
                                ?>

                                    <li>
                                        <a hreflang="{{ $localeCode }}"
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                            class="dropdown-item {{$localeCode == Lang::locale()? 'bg-light disabled':'' }}">
                                            <img id="header-lang-img2"
                                                src="{{ asset('assets') }}/images/languages/{{$flag}}"
                                                alt="Header Language" class="rounded" height="20"> {{$language}}</a>
                                    </li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                        </li>
                    </ul>

                </div>
        </nav>
        <!-- end navbar -->

        @yield('content')

        <!-- footer  -->
        <hr class="my-5">
        <footer class="container my-5">
            <div class="row d-flex justify-content-between">
                <div class="col-md-8 col-6  ">
                    <ul class="">
                        <li class="list-group mb-2">
                            <a class="navbar-brand" href="#">
                                <img src="{{asset('assets/images/logo.png')}}" alt="logo" width="70" height="55">
                            </a>
                        </li>
                        <li class="list-group mb-2">
                          <p class="h6 text-muted"><i class="fa-solid fa-phone"></i> {{__('lang.customer_service')}}</p>
                          <p class="h6 text-muted">923843487</p>
                          <p class="h6 text-muted">{{__('lang.from') .' '. 9 .' '. __('lang.to') .' '. 6 }}<p>
                        </li>
                    </ul>
                </div>


                <div class="col-md-2 col-6 mt-4">
                    <ul class="">
                        <li class="list-group d-flex my-2"><a class="text-decoration-none text-muted" href="{{route('message.index')}}">{{__('lang.contact_us')}}</a></li>
                        <li class="list-group d-flex my-2"><a class="text-decoration-none text-muted" href="{{route('faq')}}">{{__('lang.faqs')}}</a> </li>
                    </ul>
                </div>
                   <div class="col-md-2 col-6 mt-4">
                    <ul class="">
                        <li class="list-group d-flex my-2"><a class="text-decoration-none text-muted" href="{{route('message.index')}}">{{__('lang.contact_us')}}</a></li>
                        <li class="list-group d-flex my-2"><a class="text-decoration-none text-muted" href="{{route('faq')}}">{{__('lang.faqs')}}</a> </li>
                    </ul>
                </div>
                
            </div>
            <hr>
            <div class="row ">

                <div class="col-md-4 col-12 mt-4 text-center">
                    <span class="text-muted h5">{{__('lang.all_rights_reserved') .' '. date('Y') .' '. __('lang.company_name')}} </span>
                </div>
                @guest
                <div class="col-md-4 col-12 mt-4 text-center">
                    <span>                       
                        <a type="button" class="fs-7 bg-main text-light btn rounded-lg text-decoration-none"
                            data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            {{__('lang.home_login_title')}} | {{__('lang.home_sginup_title')}}
                        </a>
                    </span>
                </div>
                @endguest
                <div class="col-md-4 col-12 mt-4 text-center">
                    <a class="text-decoration-none text-muted mx-2 h5" href="#">
                        <i class="fa-brands fa-square-facebook fa-fw d-inline me-2 "></i>
                    </a>

                    <a class="text-decoration-none text-muted mx-2 h5" href="#">
                        <i class="fa-brands fa-square-twitter fa-fw d-inline me-2 "></i>
                    </a>
                   
                    <a class="text-decoration-none text-muted mx-2 h5" href="#">
                        <i class="fa-brands fa-square-youtube fa-fw d-inline me-2 "></i>
                    </a>

                    <a class="text-decoration-none text-muted mx-2 h5" href="#">
                        <i class="fa-brands fa-square-instagram fa-fw d-inline me-2 "></i>
                    </a>
                </div>


            </div>
        </footer>
        <!-- end footer -->


        <!-- sgin in Modal -->
        <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-lg">
                    <div class=" text-end p-2 pb-0 ">
                        <button type="button" class="btn-close border rounded-lg" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-header border-bottom-0 pt-0 pb-2 row ">
                        <div class="col-12">
                            <img src="{{asset('assets/images/logo.png')}}" alt="logo" width="70" height="55">
                        </div>
                    </div>
                    <div class="modal-body pt-0">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="sginin-tab" data-bs-toggle="tab"
                                    data-bs-target="#sginin" type="button" role="tab" aria-controls="sginin"
                                    aria-selected="true">{{__('lang.modal_sginin_title')}}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="sginup-tab" data-bs-toggle="tab" data-bs-target="#sginup"
                                    type="button" role="tab" aria-controls="sginup"
                                    aria-selected="false">{{__('lang.modal_sginup_title')}}</button>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="sginin" role="tabpanel"
                                aria-labelledby="sginin-tab">

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row d-flex justify-content-center  ">
                                        <div class="col-12 ">
                                            <div class="my-3">
                                                <div class="form-floating">

                                                    <input name="email" value="{{ old('email') }}" required autofocus
                                                        dir="rtl" type="email"
                                                        class="form-control  rounded-lg text-start" id="Email"
                                                        placeholder="البريد الالكتروني">
                                                    <label for="Email"
                                                        class="form-label text-muted fw-bold">{{__('lang.email')}}</label>
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="my-3">
                                                <div class="form-floating">
                                                    <input name="password" dir="rtl" type="password"
                                                        class="form-control  rounded-lg text-start" id="password"
                                                        placeholder="كلمه السر">
                                                    <label for="password"
                                                        class="form-label text-muted fw-bold">{{__('lang.password')}}</label>
                                                    @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="text-end">
                                                <button type="submit"
                                                    class="btn bg-main text-light rounded-lg py-2 px-3">{{__('lang.sginin_btn')}}</button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="sginup" role="tabpanel" aria-labelledby="sginup-tab">


                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row d-flex justify-content-center ">
                                        <div class="col-12">
                                            <div class="my-3">
                                                <div class="my-3">
                                                    <div class="form-floating">
                                                        <input name="name" dir="rtl" type="name"
                                                            class="form-control  rounded-lg text-start" id="name"
                                                            placeholder="كلمه السر">
                                                        <label for="name"
                                                            class="form-label text-muted fw-bold">{{__('lang.name')}}</label>
                                                        @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-floating">

                                                    <input name="email" value="{{ old('email') }}" required autofocus
                                                        dir="rtl" type="email"
                                                        class="form-control  rounded-lg text-start" id="Email"
                                                        placeholder="البريد الالكتروني">
                                                    <label for="Email"
                                                        class="form-label text-muted fw-bold">{{__('lang.email')}}</label>
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="my-3">
                                                <div class="form-floating">
                                                    <input name="password" dir="rtl" type="password"
                                                        class="form-control  rounded-lg text-start" id="password"
                                                        placeholder="كلمه السر">
                                                    <label for="password"
                                                        class="form-label text-muted fw-bold">{{__('lang.password')}}</label>
                                                    @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="my-3">
                                                <div class="form-floating">
                                                    <input name="password_confirmation" dir="rtl"
                                                        type="password"
                                                        class="form-control  rounded-lg text-start"
                                                        id="password_confirmation" placeholder="كلمه السر">
                                                    <label for="password_confirmation"
                                                        class="form-label text-muted fw-bold">{{__('lang.password_confirmation')}}</label>
                                                    @error('password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="text-end">
                                                <button type="submit"
                                                    class="btn bg-main text-light rounded-lg py-2 px-3">{{__('lang.sginup_btn')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="price">
            <input type="hidden" id="grandTotal">
            <input type="hidden" id="total">
            <input type="hidden" id="totalDays">
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<script>

    $(".owl-carousel").owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplaySpeed: 1000,
        nav: true,
        navSpeed: 2000,
        autoplayHoverPause: true,
        lazyLoad: true,
        dots:true,
        // navText:['<','>'],
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            960: {
                items: 4
            },
            1200: {
                items: 6
            }
        }
    });


</script>
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
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
        </div>
</body>

</html>