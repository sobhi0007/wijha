@extends('owner.auth.auth_master')
@section('title', __('lang.login_title'))

@section('content')

    <form class="col-lg-3 col-md-6 col-10 mx-auto text-center" action="{{ route('owner.login') }}" method="POST">
        @csrf

        <div class="text-center">
            @include('owner.partials.language')
        </div>

        {{-- LOGO --}}
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('owner.login') }}">
            <img src="{{ asset('assets') }}/images/logo.png" alt="Dahsboard Logo" width="80%">
        </a>

        <h1 class="h6 mb-4 text-primary">{{ __('lang.login_quote_owner') }}</h1>

        <!-- Session Status -->
        <x-auth-session-status class="mb-3" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-3" :errors="$errors" />

        <div class="form-group">
            <label for="inputemailOrPhone" class="sr-only">{{ __('lang.emailOrPhone') }}</label>
            <input type="emailOrPhone" id="inputemailOrPhone" class="form-control form-control-lg" placeholder="{{ __('lang.emailOrPhone') }}"
                required="" autofocus="" name="emailOrPhone" value="{{ old('emailOrPhone') }}">
        </div>

        <div class="form-group">
            <label for="inputPassword" class="sr-only">{{ __('lang.password') }}</label>
            <input type="password" id="inputPassword" class="form-control form-control-lg"
                placeholder="{{ __('lang.password') }}" name="password" required>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" id="remember-check" name="remember"> {{ __('lang.remember_me') }}
            </label>
        </div>

        <button class="btn btn-lg btn-primary btn-block mb-2" type="submit">{{ __('lang.login_btn') }}</button>

        <a href="{{ route('owner.register') }}">{{ __('lang.register_instead') }}</a> |
        <a href="{{ route('owner.password.request') }}">{{ __('lang.forgot_password') }}</a>

        {{-- Copyright --}}
        <p class="mt-5 mb-3 text-muted">@include('owner.partials.copyright')</p>

    </form>

@endsection
