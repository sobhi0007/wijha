@extends('owner.auth.auth_master')
@section('title', __('lang.register'))

@section('content')

    <form class="col-lg-4 col-md-6 col-10 mx-auto text-center" action="{{ route('owner.register') }}" method="POST">
        @csrf

        <div class="text-center">
            @include('owner.partials.language')
        </div>

        {{-- LOGO --}}
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('owner.register') }}">
            <img src="{{ asset('assets') }}/images/logo.png" alt="Dahsboard Logo" width="80%">
        </a>

        <h1 class="h6 mb-4 text-primary">{{ __('lang.register_quote') }}</h1>

        <!-- Session Status -->
        <x-auth-session-status class="mb-3" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-3" :errors="$errors" />

        <div class="form-group">
            <label for="inputEmail" class="sr-only">{{ __('lang.name') }}</label>
            <input type="text" id="inputEmail" class="form-control form-control-lg" placeholder="{{ __('lang.name') }}"
                required="" autofocus="" name="name" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="inputEmail" class="sr-only">{{ __('lang.email') }}</label>
            <input type="email" id="inputEmail" class="form-control form-control-lg" placeholder="{{ __('lang.email') }}"
                required="" name="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="phone" class="sr-only">{{__('lang.phone')}}</label>
            <input type="phone" id="phone" class="form-control form-control-lg" placeholder="{{__('lang.phone')}}"
                required="" name="phone" value="{{ old('phone') }}">
        </div>

        <div class="form-group">
            <label for="inputPassword" class="sr-only">{{ __('lang.password') }}</label>
            <input type="password" id="inputPassword" class="form-control form-control-lg"
                placeholder="{{ __('lang.password') }}" name="password" required>
        </div>

        <div class="form-group">
            <label for="inputPasswordConfirmation" class="sr-only">{{ __('lang.password_confirmation') }}</label>
            <input type="password" class="form-control form-control-lg"
                placeholder="{{ __('lang.password_confirmation') }}" name="password_confirmation" required>
        </div>

        <button class="btn btn-lg btn-primary btn-block mb-2" type="submit">{{ __('lang.register_btn') }}</button>

        <a href="{{ route('owner.login') }}">{{ __('lang.already_registered') }}</a>

        {{-- Copyright --}}
        <p class="mt-5 mb-3 text-muted">@include('owner.partials.copyright')</p>

    </form>

@endsection
