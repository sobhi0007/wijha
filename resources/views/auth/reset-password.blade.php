@extends('layouts.home')


@section('content')

<div class="container col-12 col-md-6">
    <div class="card shadow p-5 my-3 rounded-lg">

   
    <div class="mb-4 text-sm text-secondary">
        <h3>{{__('lang.reset_password')}}</h3>
                    <hr class="title-hr">
        {{ __('lang.reset_password_title') }}
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="form-floating my-2">

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

        <!-- Password -->
        <div class="form-floating my-2">
            <input name="password" dir="rtl"
                type="password"
                class="form-control  rounded-lg text-start"
                id="password" placeholder="كلمه السر" 
                required >
            <label for="password"
                class="form-label text-muted fw-bold">{{__('lang.password')}}</label>
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-floating my-2">
            <input name="password_confirmation" dir="rtl"
                type="password"
                class="form-control  rounded-lg text-start"
                id="password_confirmation" placeholder="كلمه السر" 
                required >
            <label for="password_confirmation"
                class="form-label text-muted fw-bold">{{__('lang.password_confirmation')}}</label>
            @error('password_confirmation')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{__('lang.reset_password')}}
            </x-primary-button>
        </div>
    </form>

</div>
</div>
@endsection