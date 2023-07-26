@extends('owner.master')
@section('title', __('lang.payments'))
@section('payments_active', 'active bg-light')
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('lang.payments') }}</h2>
            </div>
        </div>
    </div>

    {{-- Filteration --}}
    @includeIf("$directory.filter")

    {{-- Table --}}
    <div class="card" id="mainCont">
        <div class="card-body">

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table align-middle table-nowrap font-size-14">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-primary" width="5%">#</th>
                            <th class="text-primary">{{ __('lang.booking') }}</th>
                            <th class="text-primary">{{ __('lang.unit') }}</th>
                            <th class="text-primary">{{ __('lang.amount') }} {{ lang('currency') }}</th>
                            <th class="text-primary">{{ __('lang.payment_method') }}</th>
                            <th class="text-primary" width="11%">{{ __('lang.status') }}</th>
                            <th class="text-primary" width="11%">{{ __('lang.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($data['data']) > 0)
                            @foreach ($data['data'] as $key => $item)
                                <tr>
                                    <td>{{ $data['data']->firstItem() + $loop->index }}</td>
                                    <td>{{ $item->booking?->reference_number }}</td>
                                    <td>{{ $item->booking?->unit?->code }}</td>
                                    <td>{{ $item->percentageAmount() }}</td>
                                    <td>{{ $item->payment_method }}</td>
                                    <td>
                                        <span class="badge {{ $item->status->color() }} text-white">
                                            <i class="{{ $item->status->icon() }}"></i>
                                            {{ $item->status->lang() }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('owner.payments.show', ['payment' => $item]) }}"
                                            class="btn btn-primary btn-sm displayClass"
                                            data-title="{{ __('lang.show_payment') }}" data-toggle="modal"
                                            data-target="#mainModal">
                                            <span class="bx bx-show-alt"></span>
                                            {{ __('lang.show') }}
                                        </a>
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
@endsection

@includeIf("$directory.scripts")
@includeIf("$directory.pushScripts")
