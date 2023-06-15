@extends('dashboard.master')
@section('title', __('lang.social_settings'))
@section('social_settings_active', 'active bg-light')
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('lang.social_settings') }}</h2>
            </div>
        </div>
    </div>

    {{-- Edit Form --}}
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.settings.update', ['setting' => $setting]) }}" method="post" id="edit_form"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div id="edit_form_messages"></div>

                {{-- MODIFICATIONS FROM HERE --}}
                <div class="row" id="mainCont">

                    <div class="form-group col-12 col-md-6">
                        <label class="form-label">{{ __('lang.facebook') }}</label>
                        <input type="url" class="border form-control" name="facebook"
                            placeholder="{{ __('lang.please_enter') }} {{ __('lang.facebook') }}..."
                            value="{{ $setting->facebook }}">
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label class="form-label">{{ __('lang.linkedin') }}</label>
                        <input type="url" class="border form-control" name="linkedin"
                            placeholder="{{ __('lang.please_enter') }} {{ __('lang.linkedin') }}..."
                            value="{{ $setting->linkedin }}">
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label class="form-label">{{ __('lang.youtube') }}</label>
                        <input type="url" class="border form-control" name="youtube"
                            placeholder="{{ __('lang.please_enter') }} {{ __('lang.youtube') }}..."
                            value="{{ $setting->youtube }}">
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label class="form-label">{{ __('lang.twitter') }}</label>
                        <input type="url" class="border form-control" name="twitter"
                            placeholder="{{ __('lang.please_enter') }} {{ __('lang.twitter') }}..."
                            value="{{ $setting->twitter }}">
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label class="form-label">{{ __('lang.instagram') }}</label>
                        <input type="url" class="border form-control" name="instagram"
                            placeholder="{{ __('lang.please_enter') }} {{ __('lang.instagram') }}..."
                            value="{{ $setting->instagram }}">
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label class="form-label">{{ __('lang.pinterest') }}</label>
                        <input type="url" class="border form-control" name="pinterest"
                            placeholder="{{ __('lang.please_enter') }} {{ __('lang.pinterest') }}..."
                            value="{{ $setting->pinterest }}">
                    </div>

                </div>
                {{-- MODIFICATIONS TO HERE --}}

                <div class="form-group mt-3">
                    <button type="button" class="btn btn-primary" id="submit_edit_form">
                        {{ __('lang.update') }}
                        @include('dashboard.modals.spinner')
                    </button>
                </div>
            </form>

        </div>
    </div>

    @includeIf("$directory.scripts")
    @includeIf("$directory.pushScripts")
@endsection
