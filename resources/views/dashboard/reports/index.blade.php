@extends('dashboard.master')
@section('title', __('lang.reports'))
@section('reports_active', 'active bg-light')
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('lang.reports') }}</h2>
            </div>
        </div>
    </div>

    {{-- Search form --}}
    <div class="card" id="mainCont">
        <div class="card-body">

            <form action="{{ url()->current() }}" method="get" class="bg-light border border-primary rounded p-2">

                {{-- MODIFICATIONS FROM HERE --}}
                <div class="row">

                    <div class="col-md-7">
                        <label class="label-filter">{{ __('lang.date') }}</label>
                        <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd"
                            data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                            <input type="date" class="form-control" name="start"
                                placeholder="{{ __('lang.date_from') }}" value="{{ request()->input('start') }}" />
                            <input type="date" class="form-control" name="end" placeholder="{{ __('lang.date_to') }}"
                                value="{{ request()->input('end') }}" />
                        </div>
                    </div>

                    <div class="form-group col-sm-12 col-md-3">
                        <label class="form-label">{{ __('lang.type') }}</label>
                        <div name="type">
                            <select class="border form-control select2" name="type" style="width: 100%">
                                <option value="">{{ __('lang.select_type') }}</option>
                                <option value="bookings" @if (request()->input('type') == 'bookings') selected @endif>
                                    {{ __('lang.bookings') }}</option>
                                <option value="units" @if (request()->input('type') == 'units') selected @endif>
                                    {{ __('lang.units') }}</option>
                                <option value="payments" @if (request()->input('type') == 'payments') selected @endif>
                                    {{ __('lang.payments') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2" style="margin-top:1.80rem">
                        <button type="submit" class="btn btn-primary w-100">
                            {{ __('lang.filter') }}
                        </button>
                    </div>

                </div>
                {{-- MODIFICATIONS TO HERE --}}

            </form>

        </div>
    </div>

    {{-- Bookings Result --}}
    @if (isset($data['type']) && $data['type'] == 'bookings')
        <div class="card mt-3" id="mainCont">
            <div class="card-body">

                @if (count($data['data']) > 0)
                    <a href="{{ route('admin.reports.export', array_merge(request()->query())) }}"
                        class="btn btn-sm btn-primary text-white mb-2">
                        {{ __('lang.export') }}
                    </a>
                @endif

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
                            @if (count($data['data']) > 0)
                                @foreach ($data['data'] as $key => $item)
                                    <tr>
                                        <td>{{ $data['data']->firstItem() + $loop->index }}</td>
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

                {{ $data['data']->appends(request()->query())->render('pagination::bootstrap-4') }}

            </div>
        </div>
    @endif

    {{-- Units Result --}}
    @if (isset($data['type']) && $data['type'] == 'units')
        <div class="card mt-3" id="mainCont">
            <div class="card-body">

                @if (count($data['data']) > 0)
                    <a href="{{ route('admin.reports.export', array_merge(request()->query())) }}"
                        class="btn btn-sm btn-primary text-white mb-2">
                        {{ __('lang.export') }}
                    </a>
                @endif

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
                            @if (count($data['data']) > 0)
                                @foreach ($data['data'] as $key => $item)
                                    <tr>
                                        <td>{{ $data['data']->firstItem() + $loop->index }}</td>
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

                {{ $data['data']->appends(request()->query())->render('pagination::bootstrap-4') }}

            </div>
        </div>
    @endif

    {{-- Payments Result --}}
    @if (isset($data['type']) && $data['type'] == 'payments')
        <div class="card mt-3" id="mainCont">
            <div class="card-body">

                @if (count($data['data']) > 0)
                    <a href="{{ route('admin.reports.export', array_merge(request()->query())) }}"
                        class="btn btn-sm btn-primary text-white mb-2">
                        {{ __('lang.export') }}
                    </a>
                @endif

                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap font-size-14">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-primary" width="5%">#</th>
                                <th class="text-primary">{{ __('lang.booking') }}</th>
                                <th class="text-primary">{{ __('lang.amount') }} {{ __('lang.currency') }}</th>
                                <th class="text-primary">{{ __('lang.payment_method') }}</th>
                                <th class="text-primary" width="11%">{{ __('lang.status') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (count($data['data']) > 0)
                                @foreach ($data['data'] as $key => $item)
                                    <tr>
                                        <td>{{ $data['data']->firstItem() + $loop->index }}</td>
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

                {{ $data['data']->appends(request()->query())->render('pagination::bootstrap-4') }}

            </div>
        </div>
    @endif

@endsection

@includeIf("$directory.scripts")
@includeIf("$directory.pushScripts")
