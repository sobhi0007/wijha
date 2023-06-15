@extends('dashboard.master')
@section('title', __('lang.types'))
@section('types_active', 'active bg-light')
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('lang.types') }}</h2>

                @if (permission(['add_types']))
                    <div class="page-title-right">
                        <a href="{{ route('admin.types.create') }}" data-title="{{ __('lang.add_new_type') }}" id="add_btn"
                            class="btn btn-primary" data-toggle="modal" data-target="#mainModal">
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
                            <th class="text-primary">{{ __('lang.name') }} {{ lang('en') }}</th>
                            <th class="text-primary">{{ __('lang.name') }} {{ lang('ar') }}</th>
                            <th class="text-primary" width="11%">{{ __('lang.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($data['data']) > 0)
                            @foreach ($data['data'] as $key => $item)
                                <tr>
                                    <td>{{ $data['data']->firstItem() + $loop->index }}</td>
                                    <td>{{ $item->name_en }}</td>
                                    <td>{{ $item->name_ar }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button"
                                                data-toggle="dropdown" aria-expanded="false">
                                                {{ __('lang.actions') }} <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                {{-- @if (permission(['show_types']))
                                                    <a href="{{ route('admin.types.show', ['type' => $item]) }}"
                                                        class="dropdown-item displayClass"
                                                        data-title="{{ __('lang.show_type') }}" data-toggle="modal"
                                                        data-target="#mainModal">
                                                        <span class="bx bx-show-alt"></span>
                                                        {{ __('lang.show') }}
                                                    </a>
                                                @endif --}}

                                                @if (permission(['edit_types']))
                                                    <a href="{{ route('admin.types.edit', ['type' => $item]) }}"
                                                        class="dropdown-item editClass"
                                                        data-title="{{ __('lang.edit_type') }}" data-toggle="modal"
                                                        data-target="#mainModal">
                                                        <span class="bx bx-edit-alt"></span>
                                                        {{ __('lang.edit') }}
                                                    </a>
                                                @endif

                                                @if (permission(['delete_types']))
                                                    <a class="dropdown-item deleteClass"
                                                        href="{{ route('admin.types.destroy', ['type' => $item]) }}"
                                                        data-title="{{ __('lang.delete_type') }}" data-toggle="modal"
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
