@extends('owner.master')

@section('title', __('lang.company_name'))

@section('content')

    <div class="col-12">

        {{-- Welcome Div --}}
        <div class="row align-items-center mb-2">
            <div class="col">
                <h2 class="h5 page-title">{{ __('lang.welcome') }}</h2>
            </div>
        </div>

        {{-- Latest Bookings --}}
        @if (isset($bookings))
            <div class="card mt-3" id="mainCont">
                <div class="card-body">

                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h2 class="h5 page-title">{{ __('lang.latest_bookings') }}</h2>
                    </div>

                    {{-- Table --}}
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap font-size-14">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-primary" width="5%">#</th>
                                    <th class="text-primary" width="20%">{{ __('lang.reference_number') }}</th>
                                    <th class="text-primary">{{ __('lang.unit') }}</th>
                                    <th class="text-primary">{{ __('lang.user') }}</th>
                                    <th class="text-primary" width="11%">{{ __('lang.status') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (count($bookings) > 0)
                                    @foreach ($bookings as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td class="text-danger">{{ $item->reference_number }}</td>
                                            <td>{{ $item->unit?->code }}</td>
                                            <td>{{ $item->user?->name }}</td>
                                            <td>
                                                <span class="badge {{ $item->status->color() }} text-white">
                                                    <i class="{{ $item->status->icon() }}"></i>
                                                    {{ $item->status->lang() }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <x-empty-alert></x-empty-alert>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        @endif

        {{-- Latest Units --}}
        @if (isset($units))
            <div class="card mt-3" id="mainCont">
                <div class="card-body">

                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h2 class="h5 page-title">{{ __('lang.latest_units') }}</h2>
                    </div>

                    {{-- Table --}}
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap font-size-14">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-primary" width="5%">#</th>
                                    <th class="text-primary" width="11%">{{ __('lang.code') }}</th>
                                    <th class="text-primary">{{ __('lang.title') }}</th>
                                    <th class="text-primary">{{ __('lang.user') }}</th>
                                    <th class="text-primary" width="11%">{{ __('lang.status') }}</th>
                                    <th class="text-primary" width="11%">{{ __('lang.activation') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (count($units) > 0)
                                    @foreach ($units as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td class="text-danger">{{ $item->code }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->user?->name }}</td>
                                            <td>
                                                <span class="badge {{ $item->status->color() }} text-white">
                                                    <i class="{{ $item->status->icon() }}"></i>
                                                    {{ $item->status->lang() }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $item->activation->color() }} text-white">
                                                    <i class="{{ $item->activation->icon() }}"></i>
                                                    {{ $item->activation->lang() }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <x-empty-alert></x-empty-alert>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        @endif

        {{-- Latest Payments --}}
        @if (isset($payments))
            <div class="card mt-3" id="mainCont">
                <div class="card-body">

                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h2 class="h5 page-title">{{ __('lang.latest_payments') }}</h2>
                    </div>

                    {{-- Table --}}
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap font-size-14">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-primary" width="5%">#</th>
                                    <th class="text-primary">{{ __('lang.booking') }}</th>
                                    <th class="text-primary">{{ __('lang.amount') }} {{ lang('currency') }}</th>
                                    <th class="text-primary">{{ __('lang.payment_method') }}</th>
                                    <th class="text-primary" width="11%">{{ __('lang.status') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (count($payments) > 0)
                                    @foreach ($payments as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->booking?->reference_number }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ $item->payment_method }}</td>
                                            <td>
                                                <span class="badge {{ $item->status->color() }} text-white">
                                                    <i class="{{ $item->status->icon() }}"></i>
                                                    {{ $item->status->lang() }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <x-empty-alert></x-empty-alert>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        @endif
    </div>

@endsection
