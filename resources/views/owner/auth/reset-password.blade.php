@extends('owner.auth.auth_master')
@section('title', __('lang.reset_password'))

@section('content')

    <form class="col-lg-3 col-md-6 col-10 mx-auto text-center" action="{{ route('owner.password.store') }}" method="POST">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="text-center">
            @include('owner.partials.language')
        </div>

        {{-- LOGO --}}
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('owner.login') }}">
            <img src="{{ asset('assets') }}/images/logo.png" alt="Dahsboard Logo" width="80%">
        </a>

        <h1 class="h6 mb-4 text-primary">{{ __('lang.forgot_password_quote_owner') }}</h1>

        <!-- Session Status -->
        <x-auth-session-status class="mb-3" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-3" :errors="$errors" />

        <div class="form-group">
            <label for="inputEmail" class="sr-only">{{ __('lang.email') }}</label>
            <input type="email" id="inputEmail" class="form-control form-control-lg" placeholder="{{ __('lang.email') }}"
                required="" autofocus="" name="email" value="{{ old('email') }}">
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

        <button class="btn btn-lg btn-primary btn-block mb-2" type="submit">{{ __('lang.reset_password') }}</button>

        {{-- Copyright --}}
        <p class="mt-5 mb-3 text-muted">@include('owner.partials.copyright')</p>

    </form>

@endsection
