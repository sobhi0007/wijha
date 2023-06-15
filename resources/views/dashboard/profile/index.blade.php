@extends('dashboard.master')
@section('title', __('lang.profile'))
@includeIf("$directory.pushStyles")

@section('content')

    <!-- page title -->
    <div class="col">
        <h2 class="h5 page-title">{{ __('lang.profile') }}</h2>
    </div>

    <div class="card">
        <div class="card-body">
            
            <div id="loading" class="m-2">
                @include('dashboard.modals.spinner')
            </div>

            <div class="row p-2">
                <div class="col-md-6">
                    <div class="row border-end border-primary me-1 p-3">

                        {{-- profile form --}}
                        <form action="{{ route('admin.profile') }}" method="post" id="information_form" enctype="multipart/form-data">
                            @csrf
                            <div id="information_form_messages"></div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label class="form-label">{{ __('lang.name') }}</label>
                                    <input type="text" class="border form-control" name="name" placeholder="{{ __('lang.please_enter') }} {{ __('lang.name') }}..." value="{{Auth::guard('admin')->user()->name}}">
                                </div>

                                <div class="form-group col-12">
                                    <label class="form-label">{{ __('lang.email') }}</label>
                                    <input type="text" class="border form-control" name="email" placeholder="{{ __('lang.please_enter') }} {{ __('lang.email') }}..." value="{{Auth::guard('admin')->user()->email}}">
                                </div>
            
                                <div class="col-12 mt-2">
                                    <button type="button" id="submit_information_form" class="btn btn-primary me-1">{{ __('lang.update') }}</button>
                                </div>
                            </div>
                        </form>
                    
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row me-1 p-3">
                        
                        {{-- Change Password --}}
                        <form class="form" action="{{ route('admin.changePassword') }}" method="post" id="password_form">
                            @csrf
                            <div id="password_form_messages"></div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label class="form-label">{{ __('lang.current_password') }}</label>
                                    <input type="password" class="border form-control" name="current_password" placeholder="{{ __('lang.please_enter') }} {{ __('lang.current_password') }}..." value="{{ old('current_password') }}">
                                </div>
        
                                <div class="form-group col-12">
                                    <label class="form-label">{{ __('lang.new_password') }}</label>
                                    <input type="password" class="border form-control" placeholder="{{ __('lang.new_password') }}" name="new_password" value="{{ old('new_password') }}"/>
                                </div>
                                
                                <div class="form-group col-12">
                                    <label class="form-label">{{ __('lang.confirm_new_password') }}</label>
                                    <input type="password" class="border form-control" placeholder="{{ __('lang.confirm_new_password') }}" name="confirm_new_password" value="{{ old('confirm_new_password') }}"/>
                                </div>
                                
                                <div class="col-12 mt-2">
                                    <button type="button" id="submit_password_form" class="btn btn-primary me-1">{{ __('lang.update') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@includeIf("$directory.scripts")
@includeIf("$directory.pushScripts")