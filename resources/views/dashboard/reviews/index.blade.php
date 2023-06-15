@extends('dashboard.master')
@section('title', __('lang.reviews'))
@section('reviews_active', 'active bg-light')
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('lang.reviews') }}</h2>

                {{-- @if (permission(['add_reviews']))
                    <div class="page-title-right">
                        <a href="{{ route('admin.reviews.create') }}" data-title="{{ __('lang.add_new_review') }}" id="add_btn"
                            class="btn btn-primary" data-toggle="modal" data-target="#mainModal">
                            {{ __('lang.add_new') }}
                        </a>
                    </div>
                @endif --}}
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
                            <th class="text-primary">{{ __('lang.user') }}</th>
                            <th class="text-primary">{{ __('lang.overall_rating') }}</th>
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
                                    <td>{{ $item->booking?->user?->name }}</td>
                                    <td>
                                        <span class="badge bg-info text-white p-1">
                                            {{ $item->overall_rating }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $item->status->color() }} text-white">
                                            <i class="{{ $item->status->icon() }}"></i>
                                            {{ $item->status->lang() }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button"
                                                data-toggle="dropdown" aria-expanded="false">
                                                {{ __('lang.actions') }} <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                @if (permission(['show_reviews']))
                                                    <a href="{{ route('admin.reviews.show', ['review' => $item]) }}"
                                                        class="dropdown-item displayClass"
                                                        data-title="{{ __('lang.show_review') }}" data-toggle="modal"
                                                        data-target="#mainModal">
                                                        <span class="bx bx-show-alt"></span>
                                                        {{ __('lang.show') }}
                                                    </a>
                                                @endif

                                                @if (permission(['edit_reviews']))
                                                    <a href="{{ route('admin.reviews.edit', ['review' => $item]) }}"
                                                        class="dropdown-item editClass"
                                                        data-title="{{ __('lang.edit_review') }}" data-toggle="modal"
                                                        data-target="#mainModal">
                                                        <span class="bx bx-edit-alt"></span>
                                                        {{ __('lang.edit') }}
                                                    </a>
                                                @endif

                                                @if (permission(['delete_reviews']))
                                                    <a class="dropdown-item deleteClass"
                                                        href="{{ route('admin.reviews.destroy', ['review' => $item]) }}"
                                                        data-title="{{ __('lang.delete_review') }}" data-toggle="modal"
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