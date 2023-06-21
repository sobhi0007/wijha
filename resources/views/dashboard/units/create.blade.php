@extends('dashboard.master')
@section('title', __('lang.add_new_unit'))
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('lang.add_new_unit') }}</h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.units.store') }}" method="post" id="add_form" enctype="multipart/form-data">
                @csrf

                <div id="add_form_messages"></div>

                {{-- MODIFICATIONS FROM HERE --}}
                <div class="row">
                    {{-- STATUS  DIV --}}
                    <div class="border border-primary rounded p-2 col-12">
                        <div class="row">

                            <div class="form-group col-12 col-md-3">
                                <label class="form-label">{{ __('lang.user') }}</label>
                                <div name="basic[user_id]">
                                    <select class="border form-control select2" name="basic[user_id]" id="user_id">
                                        <option value="">{{ __('lang.select_user') }}</option>
                                        @foreach ($users as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label class="form-label">{{ __('lang.category') }}</label>
                                <div name="basic[category_id]">
                                    <select class="border form-control select2" name="basic[category_id]" id="category_id">
                                        <option value="">{{ __('lang.select_category') }}</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">
                                                {{ LaravelLocalization::getCurrentLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label class="form-label">{{ __('lang.status') }}</label>
                                <div name="basic[status]">
                                    <select class="form-control select2" name="basic[status]">
                                        <option value="" selected>{{ __('lang.select_status') }}</option>
                                        @foreach (App\Enums\UnitStatus::cases() as $item)
                                            <option value="{{ $item->value }}">
                                                {{ $item->lang() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label class="form-label">{{ __('lang.activation') }}</label>
                                <div name="basic[activation]">
                                    <select class="form-control select2" name="basic[activation]">
                                        <option value="" selected>{{ __('lang.select_activation') }}</option>
                                        @foreach (App\Enums\UnitActivation::cases() as $item)
                                            <option value="{{ $item->value }}">
                                                {{ $item->lang() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- MAIN DATA DIV --}}
                    <div class="border border-primary rounded p-2 mt-3 col-12">
                        <div class="row">

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.city') }}</label>
                                <div name="basic[city_id]">
                                    <select class="border form-control select2" name="basic[city_id]" id="city_id"
                                        data-url="{{ route('admin.districts.getByCity') }}">
                                        <option value="">{{ __('lang.select_city') }}</option>
                                        @foreach ($cities as $item)
                                            <option value="{{ $item->id }}">
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
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.size') }} {{ __('lang.sqm') }}</label>
                                <input type="number" step="0.01" class="border form-control" name="basic[size]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.size') }}...">
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.arrival_time') }}</label>
                                <input type="time" class="border form-control" name="basic[arrival_time]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.arrival_time') }}...">
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.departure_time') }}</label>
                                <input type="time" class="border form-control" name="basic[departure_time]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.departure_time') }}...">
                            </div>

                            <div class="form-group col-12 col-md-4">
                                <label class="form-label">{{ __('lang.price') }} {{ __('lang.currency') }}</label>
                                <input type="number" step="0.01" class="border form-control" name="basic[price]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.price') }}...">
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.title') }}</label>
                                <input type="text" class="border form-control" name="basic[title]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.title') }}...">
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.description') }}</label>
                                <textarea type="text" class="border form-control" name="basic[description]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.description') }}..." rows="4"></textarea>
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.location') }}</label>
                                <div id="map" style="width:100%; height:300px;" class="border">map here</div>
                                <input type="hidden" id="coordinates" name="basic[coordinates]">
                            </div>

                        </div>
                    </div>

                    {{-- FACILITIES DIV --}}
                    <div class="border border-primary rounded p-2 mt-3 col-12">
                        <div class="row">

                            <div class="form-group col-12 col-md-3">
                                <label class="form-label">{{ __('lang.type') }}</label>
                                <div name="basic[type_id]">
                                    <select class="border form-control select2" name="basic[type_id]" id="type_id">
                                        <option value="">{{ __('lang.select_type') }}</option>
                                        @foreach ($types as $item)
                                            <option value="{{ $item->id }}">
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
                                            <option value="{{ $item->id }}">
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
                                            <option value="{{ $item->id }}">
                                                {{ LaravelLocalization::getCurrentLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label class="form-label">{{ __('lang.badge') }}</label>
                                <div name="basic[badge_id]">
                                    <select class="border form-control select2" name="basic[badge_id]" id="badge_id">
                                        <option value="">{{ __('lang.select_badge') }}</option>
                                        @foreach ($badges as $item)
                                            <option value="{{ $item->id }}">
                                                {{ LaravelLocalization::getCurrentLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label class="form-label">{{ __('lang.bedrooms_number') }}</label>
                                <div name="basic[bedrooms_number]">
                                    <input  type="number" class="border form-control " name="basic[bedrooms_number]" id="bedrooms_number" placeholder="{{ __('lang.select_bedrooms_number') }}">
                                       
                                </div>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label class="form-label">{{ __('lang.bathrooms_number') }}</label>
                                <div name="basic[bathrooms_number]">
                                    <input  type="number" class="border form-control " name="basic[bathrooms_number]" id="bathrooms_number" placeholder="{{ __('lang.select_bathrooms_number') }}">
                                       
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label mb-0">{{ __('lang.pools') }}</label>
                                <div name="pools[]">
                                    @foreach ($pools as $item)
                                        <div class="custom-control custom-checkbox d-inline mr-2">
                                            <input type="checkbox" class="custom-control-input" name="pools[]"
                                                value="{{ $item->id }}" id="customCheckPool{{ $item->id }}">
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
                                                value="{{ $item->id }}" id="customCheckView{{ $item->id }}">
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
                                                value="{{ $item->id }}" id="customCheckToilet{{ $item->id }}">
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
                                                value="{{ $item->id }}" id="customCheckKitchen{{ $item->id }}">
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
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.rules') }}..." rows="2"></textarea>
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.arrival_instructions') }}</label>
                                <textarea type="text" class="border form-control" name="extra[arrival_instructions]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.arrival_instructions') }}..." rows="2"></textarea>
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.cancellation_policy') }}</label>
                                <textarea type="text" class="border form-control" name="extra[cancellation_policy]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.cancellation_policy') }}..." rows="2"></textarea>
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.parking_information') }}</label>
                                <textarea type="text" class="border form-control" name="extra[parking_information]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.parking_information') }}..." rows="2"></textarea>
                            </div>

                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.wifi_information') }}</label>
                                <textarea type="text" class="border form-control" name="extra[wifi_information]"
                                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.wifi_information') }}..." rows="2"></textarea>
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
                    <button type="button" class="btn btn-primary" id="submit_add_form">
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

    <script async src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_API_KEY')}}&callback=initMap&language=<?=Lang::locale()?>"></script>
    <script>
        let map;
        var markersArray = [];

        async function initMap() {
            const center = {
                lat: 24.71,
                lng: 46.67
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: center,
            });

            // const marker = new google.maps.Marker({
            //     position: center,
            //     map,
            // });

                google.maps.event.addListener(map, "click", (event) => {
                 addMarker(event.latLng, map);

                 const coordinates = {
                lat: event.latLng.lat(),
                long: event.latLng.lng()
                };

                const jsonCoordinates = JSON.stringify(coordinates);
                document.getElementById("coordinates").value = jsonCoordinates;
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
