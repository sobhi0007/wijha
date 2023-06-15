@extends('dashboard.master')
@section('title', __('lang.terms_settings'))
@section('terms_settings_active', 'active bg-light')
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('lang.terms') }}</h2>
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

                    <div class="form-group col-12 mt-1">
                        <label class="form-label">{{ __('lang.terms') }}</label>
                        <textarea type="text" class="border form-control" name="terms" id="terms"
                            placeholder="{{ __('lang.please_enter') }} {{ __('lang.terms') }}..." rows="10">{!! $setting->terms !!}</textarea>
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

    <script>
        function initEditor(id) {
            tinymce.init({
                selector: '#' + id,
                toolbar: 'undo redo | styleselect | bold italic strikethrough subscript superscript	underline | alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                    'forecolor backcolor emoticons | copy cut paste | ',
                height: "250",
                menubar: false,
                statusbar: false,
            });
        }
        initEditor('terms');
    </script>

    <style>
        .tox-toolbar__primary {
            display: flex;
            justify-content: flex-end;
            background-color: #ececec !important;
        }
    </style>

    @includeIf("$directory.scripts")
    @includeIf("$directory.pushScripts")
@endsection
