@extends('dashboard.master')
@section('title', __('lang.contact_settings'))
@section('contact_settings_active', 'active bg-light')
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('lang.contact_settings') }}</h2>
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

                    <div class="form-group col-12">
                        <label class="form-label">{{ __('lang.address') }}</label>
                        <input type="text" class="border form-control" name="address"
                            placeholder="{{ __('lang.please_enter') }} {{ __('lang.address') }}..."
                            value="{{ $setting->address }}">
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label class="form-label">{{ __('lang.email1') }}</label>
                        <input type="email" class="border form-control" name="email1"
                            placeholder="{{ __('lang.please_enter') }} {{ __('lang.email1') }}..."
                            value="{{ $setting->email1 }}">
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label class="form-label">{{ __('lang.email2') }}</label>
                        <input type="email" class="border form-control" name="email2"
                            placeholder="{{ __('lang.please_enter') }} {{ __('lang.email2') }}..."
                            value="{{ $setting->email2 }}">
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label class="form-label">{{ __('lang.phone1') }}</label>
                        <input type="email" class="border form-control" name="phone1"
                            placeholder="{{ __('lang.please_enter') }} {{ __('lang.phone1') }}..."
                            value="{{ $setting->phone1 }}">
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label class="form-label">{{ __('lang.phone2') }}</label>
                        <input type="email" class="border form-control" name="phone2"
                            placeholder="{{ __('lang.please_enter') }} {{ __('lang.phone2') }}..."
                            value="{{ $setting->phone2 }}">
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
