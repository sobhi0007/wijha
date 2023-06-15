@extends('dashboard.master')
@section('title', __('lang.basic_settings'))
@section('basic_settings_active', 'active bg-light')
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('lang.basic_settings') }}</h2>
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

                    <div class="form-group col-12 row">
                        <div class="col-md-11">
                            <label class="form-label">{{ __('lang.logo') }}</label>
                            <div class="custom-file">
                                <label class="custom-file-label">{{ __('lang.logo') }}</label>
                                <input type="file" class="custom-file-input" id="customFile" name="logo"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.logo') }}...">
                            </div>
                        </div>

                        <div class="col-md-1 mt-4">
                            <img src="{{ $setting->getFirstMediaUrl('logo', 'thumb') }}" class="rounded" />
                        </div>
                    </div>

                    <div class="form-group
                                col-12 mt-2">
                        <label class="form-label">{{ __('lang.google_play') }}</label>
                        <input type="url" class="border form-control" name="google_play"
                            placeholder="{{ __('lang.please_enter') }} {{ __('lang.google_play') }}..."
                            value="{{ $setting->google_play }}">
                    </div>

                    <div class="form-group col-12 mt-2">
                        <label class="form-label">{{ __('lang.app_store') }}</label>
                        <input type="url" class="border form-control" name="app_store"
                            placeholder="{{ __('lang.please_enter') }} {{ __('lang.app_store') }}..."
                            value="{{ $setting->app_store }}">
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
