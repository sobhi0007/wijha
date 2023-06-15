@extends('owner.master')
@section('title', __('lang.edit_unit'))
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('lang.edit_unit') }}</h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('owner.units.update', ['unit' => $unit]) }}" method="post" id="edit_form"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div id="edit_form_messages"></div>

                {{-- MODIFICATIONS FROM HERE --}}
                <div class="row">
                    {{-- MAIN DATA DIV --}}
                    <div class="border border-primary rounded p-2 col-12">
                        <div class="row">

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.city') }}</label>
                                <div name="basic[city_id]">
                                    <select class="border form-control select2" name="basic[city_id]" id="city_id"
                                        data-url="{{ route('admin.districts.getByCity') }}">
                                        <option value="">{{ __('lang.select_city') }}</option>
                                        @foreach ($cities as $item)
                                            <option value="{{ $item->id }}" @selected($unit->city_id == $item->id)>
                                                {{ LaravelLocalization::getCurrentLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.district') }}</label>
                                <div name="basic[district_id]">
                                    <select class="border form-control select2" name="basic[district_id]" id="district_id">
                                        <option value="">{{ __('lang.select_district') }}</option>
                                        @foreach ($districts as $item)
                                            <option value="{{ $item->id }}" @selected($unit->district_id == $item->id)>
                                                {{ LaravelLocalization::getCurrentLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.size') }} {{ lang('sqm') }}</label>
                                <input type="number" step="0.01" class="border form-control" name="basic[size]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.size') }}..."
                                    value="{{ $unit->size }}">
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.arrival_time') }}</label>
                                <input type="time" class="border form-control" name="basic[arrival_time]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.arrival_time') }}..."
                                    value="{{ $unit->arrival_time }}">
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.departure_time') }}</label>
                                <input type="time" class="border form-control" name="basic[departure_time]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.departure_time') }}..."
                                    value="{{ $unit->departure_time }}">
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.price') }} {{ lang('currency') }}</label>
                                <input type="number" step="0.01" class="border form-control" name="basic[price]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.price') }}..."
                                    value="{{ $unit->price }}">
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.title') }}</label>
                                <input type="text" class="border form-control" name="basic[title]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.title') }}..."
                                    value="{{ $unit->title }}">
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.description') }}</label>
                                <textarea type="text" class="border form-control" name="basic[description]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.description') }}..." rows="4">{{ $unit->description }}</textarea>
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.location') }}</label>
                                <div id="map" style="width:100%; height:300px;" class="border">map here</div>
                                <input type="hidden" id="coordinates" name="basic[coordinates]"
                                    value="{{ $unit->coordinates }}">
                            </div>

                        </div>
                    </div>

                    {{-- FACILITIES DIV --}}
                    <div class="border border-primary rounded p-2 mt-3 col-12">
                        <div class="row">

                            <div class="form-group col-12 col-md-3">
                                <label class="form-label">{{ __('lang.category') }}</label>
                                <div name="basic[category_id]">
                                    <select class="border form-control select2" name="basic[category_id]" id="category_id">
                                        <option value="">{{ __('lang.select_category') }}</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" @selected($unit->category_id == $item->id)>
                                                {{ LaravelLocalization::getCurrentLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label class="form-label">{{ __('lang.type') }}</label>
                                <div name="basic[type_id]">
                                    <select class="border form-control select2" name="basic[type_id]" id="type_id">
                                        <option value="">{{ __('lang.select_type') }}</option>
                                        @foreach ($types as $item)
                                            <option value="{{ $item->id }}"@selected($unit->type_id == $item->id)>
                                                {{ LaravelLocalization::getCurrentLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label class="form-label">{{ __('lang.capacity') }}</label>
                                <div name="basic[capacity_id]">
                                    <select class="border form-control select2" name="basic[capacity_id]"
                                        id="capacity_id">
                                        <option value="">{{ __('lang.select_capacity') }}</option>
                                        @foreach ($capacities as $item)
                                            <option value="{{ $item->id }}" @selected($unit->capacity_id == $item->id)>
                                                {{ LaravelLocalization::getCurrentLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label class="form-label">{{ __('lang.person') }}</label>
                                <div name="basic[person_id]">
                                    <select class="border form-control select2" name="basic[person_id]" id="person_id">
                                        <option value="">{{ __('lang.select_person') }}</option>
                                        @foreach ($persons as $item)
                                            <option value="{{ $item->id }}" @selected($unit->person_id == $item->id)>
                                                {{ LaravelLocalization::getCurrentLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label mb-0">{{ __('lang.pools') }}</label>
                                <div name="pools[]">
                                    @foreach ($pools as $item)
                                        <div class="custom-control custom-checkbox d-inline mr-2">
                                            <input type="checkbox" class="custom-control-input" name="pools[]"
                                                value="{{ $item->id }}" id="customCheckPool{{ $item->id }}"
                                                @checked($unit->pools->contains($item->id))>
                                            <label class="custom-control-label" for="customCheckPool{{ $item->id }}">
                                                {{ LaravelLocalization::getCurrentLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label mb-0">{{ __('lang.views') }}</label>
                                <div name="views[]">
                                    @foreach ($views as $item)
                                        <div class="custom-control custom-checkbox d-inline mr-2">
                                            <input type="checkbox" class="custom-control-input" name="views[]"
                                                value="{{ $item->id }}" id="customCheckView{{ $item->id }}"
                                                @checked($unit->views->contains($item->id))>
                                            <label class="custom-control-label" for="customCheckView{{ $item->id }}">
                                                {{ LaravelLocalization::getCurrentLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label mb-0">{{ __('lang.toilets') }}</label>
                                <div name="toilets[]">
                                    @foreach ($toilets as $item)
                                        <div class="custom-control custom-checkbox d-inline mr-2">
                                            <input type="checkbox" class="custom-control-input" name="toilets[]"
                                                value="{{ $item->id }}" id="customCheckToilet{{ $item->id }}"
                                                @checked($unit->toilets->contains($item->id))>
                                            <label class="custom-control-label"
                                                for="customCheckToilet{{ $item->id }}">
                                                {{ LaravelLocalization::getCurrentLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label mb-0">{{ __('lang.kitchens') }}</label>
                                <div name="kitchens[]">
                                    @foreach ($kitchens as $item)
                                        <div class="custom-control custom-checkbox d-inline mr-2">
                                            <input type="checkbox" class="custom-control-input" name="kitchens[]"
                                                value="{{ $item->id }}" id="customCheckKitchen{{ $item->id }}"
                                                @checked($unit->kitchens->contains($item->id))>
                                            <label class="custom-control-label"
                                                for="customCheckKitchen{{ $item->id }}">
                                                {{ LaravelLocalization::getCurrentLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- EXTRA DATA DIV --}}
                    <div class="border border-primary rounded p-2 mt-3 col-12">
                        <div class="row">

                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.rules') }}</label>
                                <textarea type="text" class="border form-control" name="extra[rules]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.rules') }}..." rows="2">{{ $unit->unitData?->rules }}</textarea>
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.arrival_instructions') }}</label>
                                <textarea type="text" class="border form-control" name="extra[arrival_instructions]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.arrival_instructions') }}..." rows="2">{{ $unit->unitData?->arrival_instructions }}</textarea>
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.cancellation_policy') }}</label>
                                <textarea type="text" class="border form-control" name="extra[cancellation_policy]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.cancellation_policy') }}..." rows="2">{{ $unit->unitData?->cancellation_policy }}</textarea>
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.parking_information') }}</label>
                                <textarea type="text" class="border form-control" name="extra[parking_information]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.parking_information') }}..." rows="2">{{ $unit->unitData?->parking_information }}</textarea>
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.wifi_information') }}</label>
                                <textarea type="text" class="border form-control" name="extra[wifi_information]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.wifi_information') }}..." rows="2">{{ $unit->unitData?->wifi_information }}</textarea>
                            </div>

                        </div>
                    </div>

                    {{-- TimeSlots Card --}}
                    <div class="border border-primary rounded p-2 mt-3 col-12">
                        <div class="card-header bg-light p-1">
                            <label class="form-label">{{ __('lang.times') }}</label>
                            <a href="#" class="btn btn-sm btn-info p-1 pt-0 pb-0"
                                id="add_new_item">{{ __('lang.add_new_time') }}</a>
                        </div>

                        <div class="card-body">
                            <div id="items_card">
                                @if (count($unit->times) > 0)
                                    @foreach ($unit->times as $time)
                                        <div class="row item_row">
                                            <div class="form-group col-sm-12 col-md-3">
                                                <label class="form-label">{{ __('lang.fromDate') }}</label>
                                                <input type="date" class="border form-control" name="fromDate[]"
                                                    placeholder="{{ __('lang.fromDate') }}..."
                                                    value="{{ $time->from }}" min="<?= date('Y-m-d') ?>">
                                            </div>

                                            <div class="form-group col-sm-12 col-md-3">
                                                <label class="form-label">{{ __('lang.toDate') }}</label>
                                                <input type="date" min="1" class="border form-control"
                                                    name="toDate[]" placeholder="{{ __('lang.toDate') }}..."
                                                    value="{{ $time->to }}" min="<?= date('Y-m-d') ?>">
                                            </div>

                                            <div class="form-group col-sm-12 col-md-2">
                                                <label class="form-label">{{ __('lang.price') }}</label>
                                                <input type="number" min="1" class="border form-control"
                                                    name="price[]" placeholder="{{ __('lang.price') }}..."
                                                    value="{{ $time->price }}">
                                            </div>

                                            <div class="form-group col-12 col-md-3">
                                                <label class="form-label">{{ __('lang.availability') }}</label>
                                                <div name="availability[]">
                                                    <select class="form-control" name="availability[]">
                                                        @foreach (App\Enums\TimeAvailability::cases() as $item)
                                                            <option value="{{ $item->value }}"
                                                                @selected($time->availability == $item)>
                                                                {{ $item->lang() }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-12 col-md-1">
                                                <button type="button"
                                                    class="delete_item_btn btn btn-sm btn-outline-danger p-2 mt-4">
                                                    {{ __('lang.delete') }}
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- IMAGES DIV --}}
                    <div class="border border-primary rounded p-2 mt-3 col-12">
                        <div class="row">

                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.images') }}</label>
                                <div class="custom-file" name="images">
                                    <label class="custom-file-label">{{ __('lang.images') }}</label>
                                    <input type="file" class="custom-file-input" id="customFile" name="images[]"
                                        placeholder="{{ __('lang.please_enter') }} {{ __('lang.images') }}..."
                                        multiple>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                {{-- MODIFICATIONS TO HERE --}}

                <div class="form-group float-right mt-2">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('lang.close') }}</button>
                    <button type="button" class="btn btn-primary" id="submit_edit_form">
                        {{ __('lang.submit') }}
                        @include('dashboard.modals.spinner')
                    </button>
                </div>
            </form>

        </div>
    </div>

    <div class="row item_row d-none" id="item_to_copy">
        <div class="form-group col-sm-12 col-md-3">
            <label class="form-label">{{ __('lang.fromDate') }}</label>
            <input type="date" class="border form-control" name="fromDate[]"
                placeholder="{{ __('lang.fromDate') }}..." min="<?= date('Y-m-d') ?>">
        </div>

        <div class="form-group col-sm-12 col-md-3">
            <label class="form-label">{{ __('lang.toDate') }}</label>
            <input type="date" class="border form-control" name="toDate[]" placeholder="{{ __('lang.toDate') }}..."
                min="<?= date('Y-m-d') ?>">
        </div>

        <div class="form-group col-sm-12 col-md-2">
            <label class="form-label">{{ __('lang.price') }}</label>
            <input type="number" min="1" class="border form-control" name="price[]"
                placeholder="{{ __('lang.price') }}...">
        </div>

        <div class="form-group col-12 col-md-3">
            <label class="form-label">{{ __('lang.availability') }}</label>
            <div name="availability[]">
                <select class="form-control" name="availability[]">
                    @foreach (App\Enums\TimeAvailability::cases() as $item)
                        <option value="{{ $item->value }}">
                            {{ $item->lang() }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group col-sm-12 col-md-1">
            <button type="button" class="delete_item_btn btn btn-sm btn-outline-danger p-2 mt-4">
                {{ __('lang.delete') }}
            </button>
        </div>
    </div>

    <script async src="https://maps.googleapis.com/maps/api/js?key=API_KEY&callback=initMap"></script>
    <script>
        let map;
        var coordinates = "<?php echo $unit->coordinates; ?>";
        const array = coordinates.replace('(', '').replace(')', '').split(", ");
        var markersArray = [];

        async function initMap() {
            const center = {
                lat: Number(array[0]),
                lng: Number(array[1])
            };

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: center,
            });

            const currentMarker = new google.maps.Marker({
                position: center,
                map,
            });
            markersArray.push(currentMarker);

            google.maps.event.addListener(map, "click", (event) => {
                addMarker(event.latLng, map);
                document.getElementById("coordinates").value = event.latLng;
            });
        }

        function addMarker(location, map) {
            clearOverlays();
            let marker = new google.maps.Marker({
                position: location,
                map: map,
            });
            markersArray.push(marker);
        }

        function clearOverlays() {
            for (var i = 0; i < markersArray.length; i++) {
                markersArray[i].setMap(null);
            }
            markersArray.length = 0;
        }

        window.initMap = initMap;
    </script>
@endsection

@includeIf("$directory.scripts")
@includeIf("$directory.pushScripts")
