@extends('owner.master')
@section('title', __("lang.$pageName"))
@section($pageName . '_active', 'active bg-light')
@section('bookings_tab_show', 'show')
@includeIf("$directory.pushStyles")

@section('content')

    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __("lang.$pageName") }}</h2>
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
                            <th class="text-primary" width="20%">{{ __('lang.reference_number') }}</th>
                            <th class="text-primary">{{ __('lang.unit') }}</th>
                            <th class="text-primary">{{ __('lang.user') }}</th>
                            <th class="text-primary" width="11%">{{ __('lang.status') }}</th>
                            <th class="text-primary" width="11%">{{ __('lang.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($data['data']) > 0)
                            @foreach ($data['data'] as $key => $item)
                                <tr>
                                    <td>{{ $data['data']->firstItem() + $loop->index }}</td>
                                    <td class="text-danger">{{ $item->reference_number }}</td>
                                    <td>{{ $item->unit?->code }}</td>
                                    <td>{{ $item->user_id != null ? $item->user?->name : $item->user_name }}</td>
                                    <td>
                                        <span class="badge {{ $item->status->color() }} text-white">
                                            <i class="{{ $item->status->icon() }}"></i>
                                            {{ $item->status->lang() }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('owner.bookings.show', ['booking' => $item]) }}"
                                            class="btn btn-primary btn-sm">
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
