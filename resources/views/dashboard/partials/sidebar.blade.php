<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('admin.index') }}">
                <img src="{{ asset('assets') }}/images/logo.png" alt="Dahsboard Logo" width="70%">
            </a>
        </div>


        <ul class="navbar-nav flex-fill w-100 mb-2">
            @if (permission('list_bookings'))
                {{-- Bookings divider --}}
                <p class="text-primary nav-heading mt-2 mb-1">
                    <span>{{ __('lang.bookings_divider') }}</span>
                </p>

                {{-- BOOKINS --}}
                <li class="nav-item dropdown">
                    <a href="#bookings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <img src="{{ asset('assets/images/bookings_icon2.png') }}" alt="bookings icon" width="30px">
                        {{-- <i class="fe fe-calendar fe-16 text-primary iconElement"></i> --}}
                        <span class="ml-3 item-text">{{ __('lang.bookings') }}</span>
                    </a>
                    <ul class="collapse @yield('bookings_tab_show') list-unstyled pl-4 w-100" id="bookings">
                        <li class="nav-item @yield('all_bookings_active')">
                            <a class="nav-link pl-3" href="{{ route('admin.bookings.index') }}">
                                <span class="ml-1 item-text">{{ __('lang.all_bookings') }}</span></a>
                        </li>
                        <li class="nav-item @yield('draft_bookings_active')">
                            <a class="nav-link pl-3"
                                href="{{ route('admin.bookings.index', ['status' => App\Enums\BookingStatus::DRAFT]) }}">
                                <span class="ml-1 item-text">{{ __('lang.draft_bookings') }}</span></a>
                        </li>
                        <li class="nav-item @yield('approved_bookings_active')">
                            <a class="nav-link pl-3"
                                href="{{ route('admin.bookings.index', ['status' => App\Enums\BookingStatus::APPROVED]) }}">
                                <span class="ml-1 item-text">{{ __('lang.approved_bookings') }}</span></a>
                        </li>
                        <li class="nav-item @yield('completed_bookings_active')">
                            <a class="nav-link pl-3"
                                href="{{ route('admin.bookings.index', ['status' => App\Enums\BookingStatus::COMPLETED]) }}">
                                <span class="ml-1 item-text">{{ __('lang.completed_bookings') }}</span></a>
                        </li>
                        <li class="nav-item @yield('rejected_bookings_active')">
                            <a class="nav-link pl-3"
                                href="{{ route('admin.bookings.index', ['status' => App\Enums\BookingStatus::REJECTED]) }}">
                                <span class="ml-1 item-text">{{ __('lang.rejected_bookings') }}</span></a>
                        </li>
                        <li class="nav-item @yield('cancelled_bookings_active')">
                            <a class="nav-link pl-3"
                                href="{{ route('admin.bookings.index', ['status' => App\Enums\BookingStatus::CANCELLED]) }}">
                                <span class="ml-1 item-text">{{ __('lang.cancelled_bookings') }}</span></a>
                        </li>
                        <li class="nav-item @yield('pending_bookings_active')">
                            <a class="nav-link pl-3"
                                href="{{ route('admin.bookings.index', ['status' => App\Enums\BookingStatus::PENDING]) }}">
                                <span class="ml-1 item-text">{{ __('lang.pending_bookings') }}</span></a>
                        </li>
                    </ul>
                </li>
            @endif

            @if (permission('list_units'))
                {{-- Units divider --}}
                <p class="text-primary nav-heading mt-2 mb-1">
                    <span>{{ __('lang.units_divider') }}</span>
                </p>

                {{-- UNITS --}}
                <li class="nav-item dropdown">
                    <a href="#units" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        {{-- <i class="fe fe-home fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/units_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.units') }}</span>
                    </a>
                    <ul class="collapse @yield('units_tab_show') list-unstyled pl-4 w-100" id="units">
                        <li class="nav-item @yield('all_units_active')">
                            <a class="nav-link pl-3" href="{{ route('admin.units.index') }}">
                                <span class="ml-1 item-text">{{ __('lang.all_units') }}</span></a>
                        </li>
                        <li class="nav-item @yield('review_units_active')">
                            <a class="nav-link pl-3"
                                href="{{ route('admin.units.index', ['status' => App\Enums\UnitStatus::REVIEW]) }}">
                                <span class="ml-1 item-text">{{ __('lang.review_units') }}</span></a>
                        </li>
                        <li class="nav-item @yield('published_units_active')">
                            <a class="nav-link pl-3"
                                href="{{ route('admin.units.index', ['status' => App\Enums\UnitStatus::PUBLISHED]) }}">
                                <span class="ml-1 item-text">{{ __('lang.published_units') }}</span></a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- PAYMENTS --}}
            @if (permission('list_payments'))
                {{-- Payments divider --}}
                <p class="text-primary nav-heading mt-2 mb-1">
                    <span>{{ __('lang.payments_divider') }}</span>
                </p>

                <li class="nav-item w-100 @yield('payments_active')">
                    <a class="nav-link" href="{{ route('admin.payments.index') }}">
                        {{-- <i class="fe fe-dollar-sign fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/payments_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.payments') }}</span>
                    </a>
                </li>
            @endif

            {{-- reports --}}
            @if (permission('list_reports'))
                {{-- reports divider --}}
                <p class="text-primary nav-heading mt-2 mb-1">
                    <span>{{ __('lang.reports_divider') }}</span>
                </p>

                <li class="nav-item w-100 @yield('reports_active')">
                    <a class="nav-link" href="{{ route('admin.reports.index') }}">
                        {{-- <i class="fe fe-clipboard fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/reports_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.reports') }}</span>
                    </a>
                </li>
            @endif

            {{-- REVIEWS --}}
            @if (permission('list_reviews'))
                {{-- Reviews divider --}}
                <p class="text-primary nav-heading mt-2 mb-1">
                    <span>{{ __('lang.reviews_divider') }}</span>
                </p>

                <li class="nav-item w-100 @yield('reviews_active')">
                    <a class="nav-link" href="{{ route('admin.reviews.index') }}">
                        {{-- <i class="fe fe-message-square fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/reviews_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.reviews') }}</span>
                    </a>
                </li>
            @endif

            {{-- Categories divider --}}
            <p class="text-primary nav-heading mt-2 mb-1">
                <span>{{ __('lang.categories_divider') }}</span>
            </p>

            {{-- CATEGORIES --}}
            @if (permission('list_categories'))
                <li class="nav-item w-100 @yield('categories_active')">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}">
                        {{-- <i class="fe fe-box fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/categories_icon.png') }}" alt="bookings icon"
                            width="30px">
                        <span class="ml-3 item-text">{{ __('lang.categories') }}</span>
                    </a>
                </li>
            @endif

            {{-- TYPES --}}
            @if (permission('list_types'))
                <li class="nav-item w-100 @yield('types_active')">
                    <a class="nav-link" href="{{ route('admin.types.index') }}">
                        {{-- <i class="fe fe-aperture fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/types_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.types') }}</span>
                    </a>
                </li>
            @endif

            {{-- CAPACITY --}}
            @if (permission('list_capacities'))
                <li class="nav-item w-100 @yield('capacities_active')">
                    <a class="nav-link" href="{{ route('admin.capacities.index') }}">
                        {{-- <i class="fe fe-users fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/capacities_icon.png') }}" alt="bookings icon"
                            width="30px">
                        <span class="ml-3 item-text">{{ __('lang.capacities') }}</span>
                    </a>
                </li>
            @endif

            {{-- PERSONS --}}
            @if (permission('list_persons'))
                <li class="nav-item w-100 @yield('persons_active')">
                    <a class="nav-link" href="{{ route('admin.persons.index') }}">
                        {{-- <i class="fe fe-user-check fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/persons_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.persons') }}</span>
                    </a>
                </li>
            @endif

            {{-- POOLS --}}
            @if (permission('list_pools'))
                <li class="nav-item w-100 @yield('pools_active')">
                    <a class="nav-link" href="{{ route('admin.pools.index') }}">
                        {{-- <i class="fe fe-codepen fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/pools_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.pools') }}</span>
                    </a>
                </li>
            @endif

            {{-- VIEWS --}}
            @if (permission('list_views'))
                <li class="nav-item w-100 @yield('views_active')">
                    <a class="nav-link" href="{{ route('admin.views.index') }}">
                        {{-- <i class="fe fe-framer fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/views_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.views') }}</span>
                    </a>
                </li>
            @endif

            {{-- BADGES --}}
            @if (permission('list_badges'))
                <li class="nav-item w-100 @yield('badges_active')">
                    <a class="nav-link" href="{{ route('admin.badges.index') }}">
                        {{-- <i class="fe fe-award fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/badges_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.badges') }}</span>
                    </a>
                </li>
            @endif

            {{-- KITCHENS --}}
            @if (permission('list_kitchens'))
                <li class="nav-item w-100 @yield('kitchens_active')">
                    <a class="nav-link" href="{{ route('admin.kitchens.index') }}">
                        {{-- <i class="fe fe-inbox fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/kitchens_icon.png') }}" alt="bookings icon"
                            width="30px">
                        <span class="ml-3 item-text">{{ __('lang.kitchens') }}</span>
                    </a>
                </li>
            @endif

            {{-- TOILETS --}}
            @if (permission('list_toilets'))
                <li class="nav-item w-100 @yield('toilets_active')">
                    <a class="nav-link" href="{{ route('admin.toilets.index') }}">
                        {{-- <i class="fe fe-wind fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/toilets_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.toilets') }}</span>
                    </a>
                </li>
            @endif

            {{-- locations divider --}}
            <p class="text-primary nav-heading mt-2 mb-1">
                <span>{{ __('lang.locations_divider') }}</span>
            </p>

            {{-- CITIES --}}
            @if (permission('list_cities'))
                <li class="nav-item w-100 @yield('cities_active')">
                    <a class="nav-link" href="{{ route('admin.cities.index') }}">
                        {{-- <i class="fe fe-map-pin fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/cities_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.cities') }}</span>
                    </a>
                </li>
            @endif

            {{-- DISTRICTS --}}
            @if (permission('list_districts'))
                <li class="nav-item w-100 @yield('districts_active')">
                    <a class="nav-link" href="{{ route('admin.districts.index') }}">
                        {{-- <i class="fe fe-flag fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/districts_icon.png') }}" alt="bookings icon"
                            width="30px">
                        <span class="ml-3 item-text">{{ __('lang.districts') }}</span>
                    </a>
                </li>
            @endif

            @if (permission('list_sliders'))
                {{-- sliders divider --}}
                <p class="text-primary nav-heading mt-2 mb-1">
                    <span>{{ __('lang.sliders_divider') }}</span>
                </p>

                {{-- Sliders --}}
                <li class="nav-item w-100 @yield('sliders_active')">
                    <a class="nav-link" href="{{ route('admin.sliders.index') }}">
                        {{-- <i class="fe fe-users fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/sliders_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.sliders') }}</span>
                    </a>
                </li>
            @endif

            @if (permission('list_messages') || permission('list_faqs'))
                {{-- Customer services divider --}}
                <p class="text-primary nav-heading mt-2 mb-1">
                    <span>{{ __('lang.customer_services_divider') }}</span>
                </p>
            @endif

            {{-- Messages --}}
            @if (permission('list_messages'))
                <li class="nav-item w-100 @yield('messages_active')">
                    <a class="nav-link" href="{{ route('admin.messages.index') }}">
                        {{-- <i class="fe fe-message-circle fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/messages_icon.png') }}" alt="bookings icon"
                            width="30px">
                        <span class="ml-3 item-text">{{ __('lang.messages') }}</span>
                    </a>
                </li>
            @endif

            {{-- FAQs --}}
            @if (permission('list_faqs'))
                <li class="nav-item w-100 @yield('faqs_active')">
                    <a class="nav-link" href="{{ route('admin.faqs.index') }}">
                        {{-- <i class="fe fe-bookmark fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/faqs_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.faqs') }}</span>
                    </a>
                </li>
            @endif

            {{-- SYSTEM MANAGEMENT --}}
            <p class="text-primary nav-heading mt-2 mb-1">
                <span>{{ __('lang.system_management') }}</span>
            </p>

            @if (permission('list_roles') || permission('list_admins'))
                <li class="nav-item dropdown">
                    <a href="#system_management" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle nav-link">
                        {{-- <i class="fe fe-home fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/system_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.system_management') }}</span><span
                            class="sr-only">(current)</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="system_management">
                        @if (permission('list_roles'))
                            <li class="nav-item @yield('roles_active')">
                                <a class="nav-link pl-3" href="{{ route('admin.roles.index') }}"><span
                                        class="ml-1 item-text">{{ __('lang.roles') }}</span></a>
                            </li>
                        @endif
                        @if (permission('list_admins'))
                            <li class="nav-item @yield('admins_active')">
                                <a class="nav-link pl-3" href="{{ route('admin.admins.index') }}"><span
                                        class="ml-1 item-text">{{ __('lang.admins') }}</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            {{-- USERS --}}
            @if (permission('list_users'))
                <li class="nav-item w-100 @yield('users_active')">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">
                        {{-- <i class="fe fe-users fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/users_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.users') }}</span>
                    </a>
                </li>
            @endif

            @if (permission('edit_settings'))
                {{-- settings divider --}}
                <p class="text-primary nav-heading mt-2 mb-1">
                    <span>{{ __('lang.settings_divider') }}</span>
                </p>

                {{-- Settings --}}
                <li class="nav-item w-100 @yield('basic_settings_active')">
                    <a class="nav-link" href="{{ route('admin.settings.basic', ['view' => 'basic']) }}">
                        {{-- <i class="fe fe-settings fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/basic_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.basic_settings') }}</span>
                    </a>
                </li>

                <li class="nav-item w-100 @yield('contact_settings_active')">
                    <a class="nav-link" href="{{ route('admin.settings.basic', ['view' => 'contact']) }}">
                        {{-- <i class="fe fe-phone fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/contact_icon.png') }}" alt="bookings icon"
                            width="30px">
                        <span class="ml-3 item-text">{{ __('lang.contact_settings') }}</span>
                    </a>
                </li>

                <li class="nav-item w-100 @yield('social_settings_active')">
                    <a class="nav-link" href="{{ route('admin.settings.basic', ['view' => 'social']) }}">
                        {{-- <i class="fe fe-facebook fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/social_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.social_settings') }}</span>
                    </a>
                </li>

                <li class="nav-item w-100 @yield('terms_settings_active')">
                    <a class="nav-link" href="{{ route('admin.settings.basic', ['view' => 'terms']) }}">
                        {{-- <i class="fe fe-file-text fe-16 text-primary"></i> --}}
                        <img src="{{ asset('assets/images/terms_icon.png') }}" alt="bookings icon" width="30px">
                        <span class="ml-3 item-text">{{ __('lang.terms_settings') }}</span>
                    </a>
                </li>
            @endif
        </ul>

        {{-- <p class="text-primary nav-heading mt-2 mb-1">
            <span>{{ __('lang.divide') }}</span>
        </p>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="dashboard">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="./index.html"><span class="ml-1 item-text">Default</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./dashboard-analytics.html"><span
                                class="ml-1 item-text">Analytics</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./dashboard-sales.html"><span
                                class="ml-1 item-text">E-commerce</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./dashboard-saas.html"><span class="ml-1 item-text">Saas
                                Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./dashboard-system.html"><span
                                class="ml-1 item-text">Systems</span></a>
                    </li>
                </ul>
            </li>
        </ul>
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Components</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#ui-elements" data-toggle="collapse" aria-expanded="false"
                    class="dropdown-toggle nav-link">
                    <i class="fe fe-box fe-16"></i>
                    <span class="ml-3 item-text">UI elements</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="ui-elements">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./ui-color.html"><span class="ml-1 item-text">Colors</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./ui-typograpy.html"><span
                                class="ml-1 item-text">Typograpy</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./ui-icons.html"><span class="ml-1 item-text">Icons</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./ui-buttons.html"><span
                                class="ml-1 item-text">Buttons</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./ui-notification.html"><span
                                class="ml-1 item-text">Notifications</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./ui-modals.html"><span
                                class="ml-1 item-text">Modals</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./ui-tabs-accordion.html"><span class="ml-1 item-text">Tabs &
                                Accordion</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./ui-progress.html"><span
                                class="ml-1 item-text">Progress</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="widgets.html">
                    <i class="fe fe-layers fe-16"></i>
                    <span class="ml-3 item-text">Widgets</span>
                    <span class="badge badge-pill badge-primary">New</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-credit-card fe-16"></i>
                    <span class="ml-3 item-text">Forms</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="forms">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_elements.html"><span class="ml-1 item-text">Basic
                                Elements</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_advanced.html"><span class="ml-1 item-text">Advanced
                                Elements</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_validation.html"><span
                                class="ml-1 item-text">Validation</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_wizard.html"><span
                                class="ml-1 item-text">Wizard</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_layouts.html"><span
                                class="ml-1 item-text">Layouts</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_upload.html"><span class="ml-1 item-text">File
                                upload</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#tables" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-grid fe-16"></i>
                    <span class="ml-3 item-text">Tables</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="tables">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./table_basic.html"><span class="ml-1 item-text">Basic
                                Tables</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./table_advanced.html"><span class="ml-1 item-text">Advanced
                                Tables</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./table_datatables.html"><span class="ml-1 item-text">Data
                                Tables</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#charts" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-pie-chart fe-16"></i>
                    <span class="ml-3 item-text">Charts</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="charts">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./chart-inline.html"><span class="ml-1 item-text">Inline
                                Chart</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./chart-chartjs.html"><span
                                class="ml-1 item-text">Chartjs</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./chart-apexcharts.html"><span
                                class="ml-1 item-text">ApexCharts</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./datamaps.html"><span
                                class="ml-1 item-text">Datamaps</span></a>
                    </li>
                </ul>
            </li>
        </ul>
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Apps</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="calendar.html">
                    <i class="fe fe-calendar fe-16"></i>
                    <span class="ml-3 item-text">Calendar</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#contact" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-book fe-16"></i>
                    <span class="ml-3 item-text">Contacts</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="contact">
                    <a class="nav-link pl-3" href="./contacts-list.html"><span class="ml-1">Contact List</span></a>
                    <a class="nav-link pl-3" href="./contacts-grid.html"><span class="ml-1">Contact Grid</span></a>
                    <a class="nav-link pl-3" href="./contacts-new.html"><span class="ml-1">New Contact</span></a>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#profile" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-user fe-16"></i>
                    <span class="ml-3 item-text">Profile</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="profile">
                    <a class="nav-link pl-3" href="./profile.html"><span class="ml-1">Overview</span></a>
                    <a class="nav-link pl-3" href="./profile-settings.html"><span class="ml-1">Settings</span></a>
                    <a class="nav-link pl-3" href="./profile-security.html"><span class="ml-1">Security</span></a>
                    <a class="nav-link pl-3" href="./profile-notification.html"><span
                            class="ml-1">Notifications</span></a>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#fileman" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-folder fe-16"></i>
                    <span class="ml-3 item-text">File Manager</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="fileman">
                    <a class="nav-link pl-3" href="./files-list.html"><span class="ml-1">Files List</span></a>
                    <a class="nav-link pl-3" href="./files-grid.html"><span class="ml-1">Files Grid</span></a>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#support" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-compass fe-16"></i>
                    <span class="ml-3 item-text">Help Desk</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="support">
                    <a class="nav-link pl-3" href="./support-center.html"><span class="ml-1">Home</span></a>
                    <a class="nav-link pl-3" href="./support-tickets.html"><span class="ml-1">Tickets</span></a>
                    <a class="nav-link pl-3" href="./support-ticket-detail.html"><span class="ml-1">Ticket
                            Detail</span></a>
                    <a class="nav-link pl-3" href="./support-faqs.html"><span class="ml-1">FAQs</span></a>
                </ul>
            </li>
        </ul>
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Extra</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#pages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-file fe-16"></i>
                    <span class="ml-3 item-text">Pages</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100 w-100" id="pages">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./page-orders.html">
                            <span class="ml-1 item-text">Orders</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./page-timeline.html">
                            <span class="ml-1 item-text">Timeline</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./page-invoice.html">
                            <span class="ml-1 item-text">Invoice</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./page-404.html">
                            <span class="ml-1 item-text">Page 404</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./page-500.html">
                            <span class="ml-1 item-text">Page 500</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./page-blank.html">
                            <span class="ml-1 item-text">Blank</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#auth" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-shield fe-16"></i>
                    <span class="ml-3 item-text">Authentication</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="auth">
                    <a class="nav-link pl-3" href="./auth-login.html"><span class="ml-1">Login 1</span></a>
                    <a class="nav-link pl-3" href="./auth-login-half.html"><span class="ml-1">Login 2</span></a>
                    <a class="nav-link pl-3" href="./auth-register.html"><span class="ml-1">Register</span></a>
                    <a class="nav-link pl-3" href="./auth-resetpw.html"><span class="ml-1">Reset
                            Password</span></a>
                    <a class="nav-link pl-3" href="./auth-confirm.html"><span class="ml-1">Confirm
                            Password</span></a>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#layouts" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-layout fe-16"></i>
                    <span class="ml-3 item-text">Layout</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="layouts">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./index.html"><span class="ml-1 item-text">Default</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./index-horizontal.html"><span class="ml-1 item-text">Top
                                Navigation</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./index-boxed.html"><span
                                class="ml-1 item-text">Boxed</span></a>
                    </li>
                </ul>
            </li>
        </ul>
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Documentation</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="../docs/index.html">
                    <i class="fe fe-help-circle fe-16"></i>
                    <span class="ml-3 item-text">Getting Start</span>
                </a>
            </li>
        </ul>
        <div class="btn-box w-100 mt-4 mb-1">
            <a href="https://themeforest.net/item/tinydash-bootstrap-html-admin-dashboard-template/27511269"
                target="_blank" class="btn mb-2 btn-primary btn-lg btn-block">
                <i class="fe fe-shopping-cart fe-12 mx-2"></i><span class="small">Buy now</span>
            </a>
        </div> --}}
    </nav>
</aside>
