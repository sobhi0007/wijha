@extends('layouts.home')


@section('content')


<div class="container">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="row d-flex justify-content-center  py-2 my-5">
            <div class="col-12 col-lg-6 ">
                <div class="my-3">
                    <h3>{{__('lang.modal_sginin_title')}}</h3>
                    <hr class="title-hr">
                    <div class="form-floating">

                        <input name="emailOrPhone" value="{{ old('emailOrPhone') }}" required autofocus dir="rtl" type="emailOrPhone"
                            class="form-control  rounded-lg text-start" id="emailOrPhone" placeholder="البريد الالكتروني">
                        <label for="emailOrPhone" class="form-label text-muted fw-bold">{{__('lang.emailOrPhone')}}</label>
                        @error('emailOrPhone')
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

                <div class="text-end">
                    <button type="submit"
                        class="btn bg-main text-light rounded-lg py-2 px-3">{{__('lang.sginin_btn')}}</button>
                </div>
                <div>
                   
                </div>
                <div class="">
                    <a class="text-decoration-none" href="{{route('password.request')}}">{{__('lang.forgotten_password')}} </a> 
                    <span class=" mx-2">|</span>
                    <span class="text-secondary"> {{__('lang.new_user')}} </span>
                    <a class="text-decoration-none" href="{{route('register')}}"> {{__('lang.join_now')}} </a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection