@extends('layouts.home')


@section('content')


<div class="container">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row d-flex justify-content-center  py-2 my-5">
            <div class="col-12 col-lg-6 ">
                <div class="my-3">
                    <h3>{{__('lang.modal_sginup_title')}}</h3>
                    <hr class="title-hr">


                    <div class="my-3">
                        <div class="form-floating">
                            <input name="name" dir="rtl" type="name" class="form-control  rounded-lg text-start"
                                id="name" placeholder="كلمه السر">
                            <label for="name" class="form-label text-muted fw-bold">{{__('lang.name')}}</label>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-floating">

                        <input name="email" value="{{ old('email') }}" required autofocus dir="rtl" type="email"
                            class="form-control  rounded-lg text-start" id="Email" placeholder="البريد الالكتروني">
                        <label for="Email" class="form-label text-muted fw-bold">{{__('lang.email')}}</label>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="my-3">
                    <div class="form-floating">
                        <input name="password" dir="rtl" type="password" class="form-control  rounded-lg text-start"
                            id="password" placeholder="كلمه السر">
                        <label for="password" class="form-label text-muted fw-bold">{{__('lang.password')}}</label>
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="my-3">
                    <div class="form-floating">
                        <input name="password_confirmation" dir="rtl" type="password"
                            class="form-control  rounded-lg text-start" id="password_confirmation"
                            placeholder="كلمه السر">
                        <label for="password_confirmation"
                            class="form-label text-muted fw-bold">{{__('lang.password_confirmation')}}</label>
                        @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit"
                        class="btn bg-main text-light rounded-lg py-2 px-3">{{__('lang.sginin_btn')}}</button>
                </div>
                <div>
                    <span class="text-secondary">{{__('lang.alread_registerd')}}</span>
                    <a href="{{route('login')}}">{{__('lang.login_btn')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection