@extends('layouts.home')


@section('content')

<div class="container col-12 col-md-6">
    <div class="card shadow p-5 my-3 rounded-lg">

   
    <div class="mb-4 text-sm text-secondary">
        <h3>{{__('lang.forgotten_password')}}</h3>
                    <hr class="title-hr">
        {{ __('lang.forgotten_password_title') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <div class="my-1">
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
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
              {{__('lang.forgotten_password_link')}}
            </x-primary-button>
        </div>
    </form>

</div>
</div>
@endsection
