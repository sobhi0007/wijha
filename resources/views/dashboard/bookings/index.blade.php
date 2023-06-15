@extends('dashboard.master')
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

                @if (permission(['add_bookings']))
                    <div class="page-title-right">
                        <a href="{{ route('admin.bookings.create') }}" data-title="{{ __('lang.add_new_booking') }}"
                            class="btn btn-primary">
                            {{ __('lang.add_new') }}
                        </a>
                    </div>
                @endif
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
                                        <div class="btn-group">
                                            <button class="btn btn-primary dropdown-toggle btn-sm" booking="button"
                                                data-toggle="dropdown" aria-expanded="false">
                                                {{ __('lang.actions') }} <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                @if (permission(['show_bookings']))
                                                    <a href="{{ route('admin.bookings.show', ['booking' => $item]) }}"
                                                        class="dropdown-item">
                                                        <span class="bx bx-show-alt"></span>
                                                        {{ __('lang.show') }}
                                                    </a>
                                                @endif

                                                @if (permission(['edit_bookings']))
                                                    <a href="{{ route('admin.bookings.edit', ['booking' => $item]) }}"
                                                        class="dropdown-item">
                                                        <span class="bx bx-edit-alt"></span>
                                                        {{ __('lang.edit') }}
                                                    </a>
                                                @endif

                                                @if (permission(['delete_bookings']))
                                                    <a class="dropdown-item deleteClass"
                                                        href="{{ route('admin.bookings.destroy', ['booking' => $item]) }}"
                                                        data-title="{{ __('lang.delete_booking') }}" data-toggle="modal"
                                                        data-target="#deleteModal">
                                                        <span class="bx bx-trash-alt"></span>
                                                        {{ __('lang.delete') }}
                                                    </a>
                                                @endif

                                            </div>
                                        </div>
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
