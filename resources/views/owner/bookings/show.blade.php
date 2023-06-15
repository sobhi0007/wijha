<?php $nameLang = LaravelLocalization::getCurrentLocale() == 'en' ? 'name_en' : 'name_ar'; ?>
@extends('owner.master')
@section('title', __('lang.show_booking'))
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('lang.show_booking') }}</h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            {{-- MODIFICATIONS FROM HERE --}}
            <div class="row">

                {{-- STATUS  DIV --}}
                <div class="border border-primary rounded p-2 col-12">
                    <div class="row">

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.code') }}</label>
                            <p class="border form-control text-danger">{{ $booking->reference_number ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.unit') }}</label>
                            <p class="border form-control">{{ $booking->unit->code ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.status') }}</label><br>
                            <span class="badge {{ $booking->status->color() }} text-white">
                                <i class="{{ $booking->status->icon() }}"></i>
                                {{ $booking->status->lang() }}
                            </span>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.user') }}</label>
                            <p class="border form-control">{{ $booking->user?->name ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.from') }}</label>
                            <p class="border form-control">{{ date('d/m/Y', strtotime($booking->from_datetime)) ?? '--' }}
                            </p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.to') }}</label>
                            <p class="border form-control">{{ date('d/m/Y', strtotime($booking->to_datetime)) ?? '--' }}
                            </p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.original_price') }} {{ lang('currency') }}</label>
                            <p class="border form-control">{{ $booking->original_price ?? '--' }}
                            </p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.vat') }} {{ lang('currency') }}</label>
                            <p class="border form-control">{{ $booking->vat ?? '--' }}
                            </p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.total_price') }} {{ lang('currency') }}</label>
                            <p class="border form-control">{{ $booking->total_price ?? '--' }}
                            </p>
                        </div>

                    </div>
                </div>

                {{-- MAIN DATA DIV --}}
                <div class="border border-primary rounded p-2 mt-3 col-12">
                    <div class="bg-light p-1 mb-2">
                        <label class="form-label">{{ __('lang.user_details') }}</label>
                    </div>

                    <div class="row">

                        <div class="form-group col-12 col-md-6">
                            <label class="form-label">{{ __('lang.name') }}</label>
                            <p class="border form-control">{{ $booking->user?->name ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label class="form-label">{{ __('lang.email') }}</label>
                            <p class="border form-control">{{ $booking->user?->email ?? '--' }}</p>
                        </div>

                    </div>
                </div>

                {{-- FACILITIES DIV --}}
                <div class="border border-primary rounded p-2 mt-3 col-12">
                    <div class="bg-light p-1 mb-2">
                        <label class="form-label">{{ __('lang.unit_details') }}</label>
                    </div>

                    <div class="row">

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.code') }}</label>
                            <p class="border form-control">{{ $booking->unit->code ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.city') }}</label>
                            <p class="border form-control">{{ $booking->unit?->city?->$nameLang ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.district') }}</label>
                            <p class="border form-control">{{ $booking->unit?->district?->$nameLang ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.arrival_time') }}</label>
                            <p class="border form-control">
                                {{ date('h:i A', strtotime($booking->unit?->arrival_time)) ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.departure_time') }}</label>
                            <p class="border form-control">
                                {{ date('h:i A', strtotime($booking->unit?->departure_time)) ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.area') }}</label>
                            <p class="border form-control">{{ $booking->unit?->area ?? '--' }}</p>
                        </div>

                    </div>
                </div>

                <a href="{{ url()->previous() }}" class="btn btn-primary mt-2">
                    {{ __('lang.back') }}
                </a>

            </div>
            {{-- MODIFICATIONS TO HERE --}}

        </div>
    </div>

@endsection

@includeIf("$directory.scripts")
@includeIf("$directory.pushScripts")
