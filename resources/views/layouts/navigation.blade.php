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
            <li class="nav-item dropdown  mx-3"><a class="nav-link line fs-7  active  " href="{{route('reservation')}}">{{__('lang.reservations')}}</a> </li>
            <li class="nav-item dropdown  mx-3"><a class="nav-link line fs-7  active  " href="{{route('wishlist')}}">{{__('lang.wishlist')}}</a> </li>
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
            <li class="nav-item dropdown  mx-3">
                <div class="dropdown">

                    <a href="#" class=" fs-7 nav-link line text-dark text-decoration-none"
                        data-bs-toggle="dropdown" aria-expanded="false">
                       {{Auth::user()->name}}
                    </a>
                    <ul class="dropdown-menu dropdown-position shadow" >
                        <li>
                            <a href="{{route('profile.edit')}}" class="dropdown-item"><i class="fa fa-user text-main mx-2" aria-hidden="true"></i>  {{__('lang.profile')}}</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" class="dropdown-item text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out text-main mx-2" aria-hidden="true"></i>  {{__('lang.logout')}}
                            </a>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
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