<?php $nameLang = LaravelLocalization::getCurrentLocale() == 'en' ? 'name_en' : 'name_ar'; ?>
@extends('owner.master')
@section('title', __('lang.show_unit'))
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('lang.show_unit') }}</h2>
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
                            <p class="border form-control text-danger">{{ $unit->code ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.status') }}</label><br>
                            <span class="badge {{ $unit->status->color() }} text-white">
                                <i class="{{ $unit->status->icon() }}"></i>
                                {{ $unit->status->lang() }}
                            </span>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.activation') }}</label><br>
                            <span class="badge {{ $unit->activation->color() }} text-white">
                                <i class="{{ $unit->activation->icon() }}"></i>
                                {{ $unit->activation->lang() }}
                            </span>
                        </div>

                    </div>
                </div>

                {{-- MAIN DATA DIV --}}
                <div class="border border-primary rounded p-2 mt-3 col-12">
                    <div class="row">

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.city') }}</label>
                            <p class="border form-control">{{ $unit->city->$nameLang ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.district') }}</label>
                            <p class="border form-control">{{ $unit->district->$nameLang ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.size') }} {{ lang('sqm') }}</label>
                            <p class="border form-control">{{ $unit->size ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.arrival_time') }}</label>
                            <p class="border form-control">{{ date('h:i A', strtotime($unit->arrival_time)) ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.departure_time') }}</label>
                            <p class="border form-control">{{ date('h:i A', strtotime($unit->departure_time)) ?? '--' }}
                            </p>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label class="form-label">{{ __('lang.price') }} {{ lang('currency') }}</label>
                            <p class="border form-control">{{ $unit->price ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12">
                            <label class="form-label">{{ __('lang.title') }}</label>
                            <p class="border form-control">{{ $unit->title ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12">
                            <label class="form-label">{{ __('lang.description') }}</label>
                            <p class="border form-control">{{ $unit->description ?? '--' }}</p>
                        </div>

                    </div>
                </div>

                {{-- FACILITIES DIV --}}
                <div class="border border-primary rounded p-2 mt-3 col-12">
                    <div class="row">

                        <div class="form-group col-12 col-md-3">
                            <label class="form-label">{{ __('lang.category') }}</label>
                            <p class="border form-control">{{ $unit->category->$nameLang ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12 col-md-3">
                            <label class="form-label">{{ __('lang.type') }}</label>
                            <p class="border form-control">{{ $unit->type->$nameLang ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12 col-md-3">
                            <label class="form-label">{{ __('lang.capacity') }}</label>
                            <p class="border form-control">{{ $unit->capacity->$nameLang ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12 col-md-3">
                            <label class="form-label">{{ __('lang.person') }}</label>
                            <p class="border form-control">{{ $unit->person->$nameLang ?? '--' }}</p>
                        </div>

                        @if (count($unit->pools) > 0)
                            <div class="form-group col-12">
                                <label class="form-label mb-0">{{ __('lang.pools') }}</label>
                                <div>
                                    @foreach ($unit->pools as $item)
                                        <div class="custom-control custom-checkbox d-inline mr-2">
                                            <input type="checkbox" class="custom-control-input" name="pools[]"
                                                value="{{ $item->id }}" id="customCheckPool{{ $item->id }}"
                                                checked disabled>
                                            <label class="custom-control-label" for="customCheckPool{{ $item->id }}">
                                                {{ LaravelLocalization::getCurrentLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if (count($unit->views) > 0)
                            <div class="form-group col-12">
                                <label class="form-label mb-0">{{ __('lang.views') }}</label>
                                <div name="views[]">
                                    @foreach ($unit->views as $item)
                                        <div class="custom-control custom-checkbox d-inline mr-2">
                                            <input type="checkbox" class="custom-control-input" name="views[]"
                                                value="{{ $item->id }}" id="customCheckView{{ $item->id }}"
                                                checked disabled>
                                            <label class="custom-control-label" for="customCheckView{{ $item->id }}">
                                                {{ LaravelLocalization::getCurrentLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if (count($unit->toilets) > 0)
                            <div class="form-group col-12">
                                <label class="form-label mb-0">{{ __('lang.toilets') }}</label>
                                <div name="toilets[]">
                                    @foreach ($unit->toilets as $item)
                                        <div class="custom-control custom-checkbox d-inline mr-2">
                                            <input type="checkbox" class="custom-control-input" name="toilets[]"
                                                value="{{ $item->id }}" id="customCheckToilet{{ $item->id }}"
                                                checked disabled>
                                            <label class="custom-control-label" for="customCheckToilet{{ $item->id }}">
                                                {{ LaravelLocalization::getCurrentLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if (count($unit->kitchens) > 0)
                            <div class="form-group col-12">
                                <label class="form-label mb-0">{{ __('lang.kitchens') }}</label>
                                <div name="kitchens[]">
                                    @foreach ($unit->kitchens as $item)
                                        <div class="custom-control custom-checkbox d-inline mr-2">
                                            <input type="checkbox" class="custom-control-input" name="kitchens[]"
                                                value="{{ $item->id }}" id="customCheckKitchen{{ $item->id }}"
                                                checked disabled>
                                            <label class="custom-control-label"
                                                for="customCheckKitchen{{ $item->id }}">
                                                {{ LaravelLocalization::getCurrentLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- EXTRA DATA DIV --}}
                <div class="border border-primary rounded p-2 mt-3 col-12">
                    <div class="row">

                        <div class="form-group col-12">
                            <label class="form-label">{{ __('lang.rules') }}</label>
                            <p class="border form-control">{{ $unit->unitData?->rules ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12">
                            <label class="form-label">{{ __('lang.arrival_instructions') }}</label>
                            <p class="border form-control">{{ $unit->unitData?->arrival_instructions ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12">
                            <label class="form-label">{{ __('lang.cancellation_policy') }}</label>
                            <p class="border form-control">{{ $unit->unitData?->cancellation_policy ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12">
                            <label class="form-label">{{ __('lang.parking_information') }}</label>
                            <p class="border form-control">{{ $unit->unitData?->parking_information ?? '--' }}</p>
                        </div>

                        <div class="form-group col-12">
                            <label class="form-label">{{ __('lang.wifi_information') }}</label>
                            <p class="border form-control">{{ $unit->unitData?->wifi_information ?? '--' }}</p>
                        </div>

                    </div>
                </div>

                {{-- TimeSlots Card --}}
                <div class="border border-primary rounded p-2 mt-3 col-12">
                    <div class="card-header bg-light p-1">
                        <label class="form-label">{{ __('lang.times') }}</label>
                    </div>

                    <div class="card-body">
                        <div id="items_card">
                            @if (count($unit->times) > 0)
                                @foreach ($unit->times as $time)
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-4">
                                            <label class="form-label">{{ __('lang.fromDate') }}</label>
                                            <p class="border form-control">{{ $time->from ?? '--' }}</p>
                                        </div>

                                        <div class="form-group col-sm-12 col-md-4">
                                            <label class="form-label">{{ __('lang.toDate') }}</label>
                                            <p class="border form-control">{{ $time->to ?? '--' }}</p>
                                        </div>

                                        <div class="form-group col-sm-12 col-md-2">
                                            <label class="form-label">{{ __('lang.price') }}</label>
                                            <p class="border form-control">{{ $time->price ?? '--' }}</p>
                                        </div>

                                        <div class="form-group col-12 col-md-2">
                                            <label class="form-label">{{ __('lang.availability') }}</label>
                                            <span class="badge {{ $time->availability->color() }} text-white mt-2">
                                                <i class="{{ $time->availability->icon() }}"></i>
                                                {{ $time->availability->lang() }}
                                            </span>
                                        </div>

                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                {{-- IMAGES DIV --}}
                @if ($unit->getMedia('images')->count() > 0)
                    <div class="border border-primary rounded p-2 mt-3 col-12">
                        <div class="row">

                            @foreach ($unit->getMedia('images') as $item)
                                <div class="form-group col-2">
                                    <img src="{{ $item->getUrl('thumb') }}" class="rounded mt-4" width="60%">
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endif

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
