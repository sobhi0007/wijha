<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('owner.index') }}">
                <img src="{{ asset('assets') }}/images/logo.png" alt="Dahsboard Logo" width="70%">
            </a>
        </div>


        <ul class="navbar-nav flex-fill w-100 mb-2">

            {{-- BOOKINS DIVIDER --}}
            <p class="text-primary nav-heading mt-2 mb-1">
                <span>{{ __('lang.bookings_divider') }}</span>
            </p>

            {{-- BOOKINS --}}
            <li class="nav-item dropdown">
                <a href="#bookings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <img src="{{ asset('assets/images/bookings_icon2.png') }}" alt="bookings icon" width="30px">
                    <span class="ml-3 item-text">{{ __('lang.bookings') }}</span>
                </a>
                <ul class="collapse @yield('bookings_tab_show') list-unstyled pl-4 w-100" id="bookings">
                    <li class="nav-item @yield('all_bookings_active')">
                        <a class="nav-link pl-3" href="{{ route('owner.bookings.index') }}">
                            <span class="ml-1 item-text">{{ __('lang.all_bookings') }}</span></a>
                    </li>
                    <li class="nav-item @yield('draft_bookings_active')">
                        <a class="nav-link pl-3"
                            href="{{ route('owner.bookings.index', ['status' => App\Enums\BookingStatus::DRAFT]) }}">
                            <span class="ml-1 item-text">{{ __('lang.draft_bookings') }}</span></a>
                    </li>
                    <li class="nav-item @yield('approved_bookings_active')">
                        <a class="nav-link pl-3"
                            href="{{ route('owner.bookings.index', ['status' => App\Enums\BookingStatus::APPROVED]) }}">
                            <span class="ml-1 item-text">{{ __('lang.approved_bookings') }}</span></a>
                    </li>
                    <li class="nav-item @yield('completed_bookings_active')">
                        <a class="nav-link pl-3"
                            href="{{ route('owner.bookings.index', ['status' => App\Enums\BookingStatus::COMPLETED]) }}">
                            <span class="ml-1 item-text">{{ __('lang.completed_bookings') }}</span></a>
                    </li>
                    <li class="nav-item @yield('rejected_bookings_active')">
                        <a class="nav-link pl-3"
                            href="{{ route('owner.bookings.index', ['status' => App\Enums\BookingStatus::REJECTED]) }}">
                            <span class="ml-1 item-text">{{ __('lang.rejected_bookings') }}</span></a>
                    </li>
                    <li class="nav-item @yield('cancelled_bookings_active')">
                        <a class="nav-link pl-3"
                            href="{{ route('owner.bookings.index', ['status' => App\Enums\BookingStatus::CANCELLED]) }}">
                            <span class="ml-1 item-text">{{ __('lang.cancelled_bookings') }}</span></a>
                    </li>
                    <li class="nav-item @yield('pending_bookings_active')">
                        <a class="nav-link pl-3"
                            href="{{ route('owner.bookings.index', ['status' => App\Enums\BookingStatus::PENDING]) }}">
                            <span class="ml-1 item-text">{{ __('lang.pending_bookings') }}</span></a>
                    </li>
                </ul>
            </li>

            {{-- Units divider --}}
            <p class="text-primary nav-heading mt-2 mb-1">
                <span>{{ __('lang.units_divider') }}</span>
            </p>

            {{-- UNITS --}}
            <li class="nav-item dropdown">
                <a href="#units" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <img src="{{ asset('assets/images/units_icon.png') }}" alt="bookings icon" width="30px">
                    <span class="ml-3 item-text">{{ __('lang.units') }}</span>
                </a>
                <ul class="collapse @yield('units_tab_show') list-unstyled pl-4 w-100" id="units">
                    <li class="nav-item @yield('all_units_active')">
                        <a class="nav-link pl-3" href="{{ route('owner.units.index') }}">
                            <span class="ml-1 item-text">{{ __('lang.all_units') }}</span></a>
                    </li>
                    <li class="nav-item @yield('review_units_active')">
                        <a class="nav-link pl-3"
                            href="{{ route('owner.units.index', ['status' => App\Enums\UnitStatus::REVIEW]) }}">
                            <span class="ml-1 item-text">{{ __('lang.review_units') }}</span></a>
                    </li>
                    <li class="nav-item @yield('published_units_active')">
                        <a class="nav-link pl-3"
                            href="{{ route('owner.units.index', ['status' => App\Enums\UnitStatus::PUBLISHED]) }}">
                            <span class="ml-1 item-text">{{ __('lang.published_units') }}</span></a>
                    </li>
                </ul>
            </li>

            {{-- Payments divider --}}
            <p class="text-primary nav-heading mt-2 mb-1">
                <span>{{ __('lang.payments_divider') }}</span>
            </p>

            {{-- PAYMENTS --}}
            <li class="nav-item w-100 @yield('payments_active')">
                <a class="nav-link" href="{{ route('owner.payments.index') }}">
                    <img src="{{ asset('assets/images/payments_icon.png') }}" alt="bookings icon" width="30px">
                    <span class="ml-3 item-text">{{ __('lang.payments') }}</span>
                </a>
            </li>

            {{-- Reviews divider --}}
            <p class="text-primary nav-heading mt-2 mb-1">
                <span>{{ __('lang.reviews_divider') }}</span>
            </p>

            {{-- REVIEWS --}}
            <li class="nav-item w-100 @yield('reviews_active')">
                <a class="nav-link" href="{{ route('owner.reviews.index') }}">
                    <img src="{{ asset('assets/images/reviews_icon.png') }}" alt="bookings icon" width="30px">
                    <span class="ml-3 item-text">{{ __('lang.reviews') }}</span>
                </a>
            </li>
        </ul>

    </nav>
</aside>
