@extends('dashboard.master')
@section('title', __('lang.edit_booking'))
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('lang.edit_booking') }}</h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.bookings.update', ['booking' => $booking]) }}" method="post" id="edit_form"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div id="edit_form_messages"></div>

                {{-- MODIFICATIONS FROM HERE --}}
                <div class="row">

                    {{-- STATUS  DIV --}}
                    <div class="border border-primary rounded p-2 col-12">
                        <div class="row">

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.code') }}</label>
                                <input type="text" class="border form-control" value="{{ $booking->reference_number }}"
                                    disabled>
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.unit') }}</label>
                                <input type="text" class="border form-control" value="{{ $booking->unit?->code }}"
                                    disabled>
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.status') }}</label>
                                <div name="status">
                                    <select class="form-control select2" name="status">
                                        <option value="" selected>{{ __('lang.select_status') }}</option>
                                        @foreach (App\Enums\BookingStatus::cases() as $item)
                                            <option value="{{ $item->value }}" @selected($booking->status == $item)>
                                                {{ $item->lang() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.user') }}</label>
                                <input type="text" class="border form-control" value="{{ $booking->user?->name }}"
                                    disabled>
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.email') }}</label>
                                <input type="text" class="border form-control"
                                    value="{{ $booking->user_id == null ? $booking->user_name : $booking->user?->name }}"
                                    disabled>
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.phone') }}</label>
                                <input type="text" class="border form-control"
                                    value="{{ $booking->user_id == null ? $booking->phone : '--' }}" disabled>
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.from') }}</label>
                                <input type="text" class="border form-control"
                                    value="{{ date('d/m/Y', strtotime($booking->from_datetime)) }}" disabled>
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.to') }}</label>
                                <input type="text" class="border form-control"
                                    value="{{ date('d/m/Y', strtotime($booking->to_datetime)) }}" disabled>
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.original_price') }} {{ lang('currency') }}</label>
                                <input type="text" class="border form-control" value="{{ $booking->original_price }}"
                                    disabled>
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.vat') }} {{ lang('currency') }}</label>
                                <input type="text" class="border form-control" value="{{ $booking->vat }}" disabled>
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.total_price') }} {{ lang('currency') }}</label>
                                <input type="text" class="border form-control" value="{{ $booking->total_price }}"
                                    disabled>
                            </div>

                        </div>
                    </div>

                </div>
                {{-- MODIFICATIONS TO HERE --}}

                <div class="form-group float-right mt-2">
                    {{-- <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('lang.close') }}</button> --}}
                    <button type="button" class="btn btn-primary" id="submit_edit_form">
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
