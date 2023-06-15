<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
    <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <ul class="nav">
    <li class="nav-item">
        <div class='nav-link'>
            @include('dashboard.partials.language')
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
        <i class="fe fe-sun fe-16"></i>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="avatar avatar-sm mt-2">
            <img src="{{ asset('assets') }}/images/avatar.png" alt="Profile image" class="avatar-img rounded-circle">
        </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="{{ route('admin.profile') }}">{{ __('lang.profile') }}</a>
            <form action="{{ route('admin.logout') }}" method="POST" class="dropdown-item">
                @csrf
                <button type="submit" class="border-0 bg-transparent p-0 text-danger">
                    <span key="t-logout">{{ __('lang.logout') }}</span>
                </button>
            </form>
        </div>
    </li>
    </ul>
</nav>