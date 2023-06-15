@extends('dashboard.master')
@section('title', __('lang.add_new_booking'))
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('lang.add_new_booking') }}</h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.bookings.store') }}" method="post" id="add_form" enctype="multipart/form-data">
                @csrf

                <div id="add_form_messages"></div>

                {{-- MODIFICATIONS FROM HERE --}}
                <div class="row">

                    {{-- STATUS  DIV --}}
                    <div class="border border-primary rounded p-2 col-12">
                        <div class="row">

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.code') }}</label>
                                <input type="text" class="border form-control" name="reference_number"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.reference_number') }}...">
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.unit') }}</label>
                                <input type="text" class="border form-control" name="unit_id"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.unit') }}...">
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.status') }}</label>
                                <div name="status">
                                    <select class="form-control select2" name="status">
                                        <option value="" selected>{{ __('lang.select_status') }}</option>
                                        @foreach (App\Enums\BookingStatus::cases() as $item)
                                            <option value="{{ $item->value }}">{{ $item->lang() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.user') }}</label>
                                <input type="text" class="border form-control" name="user_name"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.user') }}...">
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.from') }}</label>
                                <input type="date" class="border form-control" name="from_datetime"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.from_datetime') }}...">
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.to') }}</label>
                                <input type="date" class="border form-control" name="to_datetime"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.to_datetime') }}...">
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.original_price') }} {{ __('lang.currency') }}</label>
                                <input type="number" class="border form-control" name="original_price" min='0'
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.original_price') }}...">
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.vat') }} {{ __('lang.currency') }}</label>
                                <input type="number" class="border form-control" name="vat" min='0'
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.vat') }}...">
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.total_price') }} {{ __('lang.currency') }}</label>
                                <input type="number" class="border form-control" name="total_price" min='0'
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.total_price') }}...">
                            </div>

                        </div>
                    </div>

                </div>
                {{-- MODIFICATIONS TO HERE --}}

                <div class="form-group float-right mt-2">
                    {{-- <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('lang.close') }}</button> --}}
                    <button type="button" class="btn btn-primary" id="submit_add_form">
                        {{ __('lang.submit') }}
                        @include('dashboard.modals.spinner')
                    </button>
                </div>
            </form>

        </div>
    </div>

@endsection

@includeIf("$directory.scripts")
@includeIf("$directory.pushScripts")
