<div>


    <div class="container-fluid px-md-4 mt-5">
        <div class="row  justify-content-center">
            <div class="row ">
   
                <div class="">
                    <div class="alert alert-danger alert-dismissible fade show col-12" role="alert" wire:offline>
                    <strong>You are now offline !</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <h1>{{__('lang.stays_in')}} {{ $search }}</h1>
                    <p class="text-muted fw-bold"> {{__('lang.unit_count')}} {{$units->count()}} <span class="mx-2">
                    </p>
                    <div class=" my-2 col-12  ">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h5 class="accordion-header my-2" id="flush-headingOne">
                                <a class=" collapsed text-decoration-none text-secondary" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                              {{__('lang.filter_appartement')}} <i class="fa-solid fa-filter"></i>
                                </a>
                                </h5>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body border rounded-lg">
                                          <div class="row">
                                <div class="col-md-3 my-1">
                                    <div>
                                        <div class="form-floating">
                                            <select class="form-select me-2 col-6 rounded-lg" aria-label="Default select example"
                                                wire:model.defer='bedrooms'>
                                                <option value=''>{{__('lang.list_bedrooms_not_selected')}}</option>
                                                @for ($i = 1; $i <= 20; $i++) 
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            <label for="Email" class="form-label text-muted fw-bold">{{__('lang.bedrooms_number')}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 my-1">
                                    <div>
                                        <div class="form-floating">
                                            <select class="form-select me-2 col-6 rounded-lg" aria-label="Default select example"
                                                wire:model.defer='type'>
                                                <option value='' selected>{{__('lang.list_types_not_selected')}}</option>
                                                @foreach ($types as $type) 
                                                    <option value="{{$type->id}}">{{app()->getLocale() == 'ar'? $type->name_ar : $type->name_en}}</option>
                                                @endforeach
                                            </select>
                                            <label for="Email" class="form-label text-muted fw-bold">{{__('lang.list_type')}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 my-1">
                                    <div>
                                        <div class="form-floating">
                                            <select class="form-select me-2 col-6 rounded-lg" aria-label="Default select example"
                                                wire:model.defer='badge'>
                                                <option value='' selected>{{__('lang.list_badges_not_selected')}}</option>
                                                @foreach ($badges as $badge) 
                                                    <option value="{{$badge->id}}">{{app()->getLocale() == 'ar'? $badge->name_ar : $badge->name_en}}</option>
                                                @endforeach
                                            </select>
                                            <label for="Email" class="form-label text-muted fw-bold">{{__('lang.list_badges')}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 my-1">
                                    <div>
                                        <div class="form-floating">
                                            <select class="form-select me-2 col-6 rounded-lg" aria-label="Default select example"
                                                wire:model.defer='category'>
                                                <option value='' selected>{{__('lang.list_categories_not_selected')}}</option>
                                                @foreach ($categories as $category) 
                                                    <option value="{{$category->id}}">{{app()->getLocale() == 'ar'? $category->name_ar : $category->name_en}}</option>
                                                @endforeach
                                            </select>
                                            <label for="Email" class="form-label text-muted fw-bold">{{__('lang.categories')}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 my-1">
                                    <div>
                                        <div class="form-floating">
                                            <select class="form-select me-2 col-6 rounded-lg" aria-label="Default select example"
                                                wire:model.defer='person'>
                                                <option value='' selected>{{__('lang.list_persons_not_selected')}}</option>
                                                @foreach ($persons as $person) 
                                                    <option value="{{$person->id}}">{{app()->getLocale() == 'ar'? $person->name_ar : $person->name_en}}</option>
                                                @endforeach
                                            </select>
                                            <label for="Email" class="form-label text-muted fw-bold">{{__('lang.persons')}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 my-1">
                                    <div>
                                        <div class="form-floating">
                                            <select class="form-select me-2 col-6 rounded-lg" aria-label="Default select example"
                                                wire:model.defer='capacity'>
                                                <option value='' selected>{{__('lang.list_capacities_not_selected')}}</option>
                                                @foreach ($capacities as $capacity) 
                                                    <option value="{{$capacity->id}}">{{app()->getLocale() == 'ar'? $capacity->name_ar : $capacity->name_en}}</option>
                                                @endforeach
                                            </select>
                                            <label for="Email" class="form-label text-muted fw-bold">{{__('lang.capacity')}}</label>
                                        </div>
                                    </div>
                                </div>
                        </div> 
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-6 col-md-2 py-3 my-auto " dir="ltr" >
                                            <button wire:click.prevent="refresh()" class="btn col-12 col-md-12 rounded-lg bg-main text-light" wire:loading.class="disabled" wire:offline.attr="disabled">
                                            <i class="fa-solid fa-filter"></i>
                                              {{__('lang.apply')}}
                                            </button>
                                         </div>
                                         <div class="col-6 col-md-2 py-3 my-auto " dir="ltr">
                                            <button wire:click.prevent="resetAll()" class="btn col-12 col-md-12 rounded-lg bg-danger text-light" wire:loading.class="disabled" wire:offline.attr="disabled">
                                                <i class="fa-solid fa-rotate-right"></i>
                                              {{__('lang.reset')}}
                                            </button>
                                         </div>
                                    </div>
                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
                
                @if ($units->count() == 0 )
                <div class="text-center">
                    <img src="{{asset('/home-assets/common_images/notfound.png')}}" alt="" srcset="">
                    <p>{{__('lang.search_not_found')}}</p>
                </div>
                @else
                @php
                $card_num=0;
                @endphp
                <div class="col-xl-7 col-12 ">
                    @foreach ($units as $key=>$unit)
                    <div class="col-12">
                        <div class="card mb-3 rounded-lg col-12 custom-shadow overflow-hidden location-div "
                            data-lat="{{$unit->lat}}" data-lng="{{$unit->long}}">
                            <div class="row g-0">
                                <div class="col-md-5">
                                    <!-- slider -->
                                    <div class="card ">
                                        <div id="carouselExampleIndicators{{$card_num}}" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-indicators">

                                                @php
                                                $img_num=0;
                                                @endphp

                                                @foreach ($unit->image as $image)
                                                <button type="button"
                                                    data-bs-target="#carouselExampleIndicators{{$card_num}}"
                                                    data-bs-slide-to="{{$img_num}}"
                                                    class="{{$img_num == 0 ?'active':''}}"
                                                    aria-current="{{$img_num == 0 ?'true':''}}"
                                                    aria-label="Slide {{$img_num}}"></button>
                                                <?php $img_num++; ?>
                                                @endforeach

                                            </div>
                                            <div class="carousel-inner " style="width:100%; height: 250px !important;">
                                           @auth
                                            @livewire('wishlist-units', ['color' =>
                                                    in_array($unit->code, $wishlists)? 'text-danger
                                                    ':'text-light fa-beat-fade' ,'unit_id'=>$unit->code ])
                                            @endAuth
     
                                                @foreach ($unit->image as $key=>$image)
                                                <div class="carousel-item {{$key == 0 ? 'active':''}} ">
                                                    <img src="{{$image}}" class="d-block w-100" alt="...">
                                                </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselExampleIndicators{{$card_num}}"
                                                data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselExampleIndicators{{$card_num}}"
                                                data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>

                                    </div>
                                    <!-- end slider -->
                                </div>
                                <div class="col-md-7">
                                    <a href="{{route('unit.show',$unit->code)}}" class="text-decoration-none text-dark">
                                        <div class="card-body">
                                            <span class="text-muted mb-2">#{{$unit->code}}</span>
                                            <h5 class=""> {{$unit->title}}</h5>
                                            <hr class="w-25">
                                            <div class="row mb-2">
                                                <div class="col-5 pl-0 text-muted "><i class="fa-regular fa-user fa-fw me-1"></i>
                                                    <span class="fs-6">
                                                       {{Lang::locale()== 'en' ? $unit->capacity->name_en :$unit->capacity->name_ar}}
                                                    </span>    
                                                </div>
                                                <div class="col-3 m-0 p-0 text-muted fs-6 "><i class="fa-regular fa-bath fa-fw me-1 "></i>
                                                    {{$unit->bathrooms_number . ' ' . __('lang.bathrooms') }}</div>
                                                <div class="col-4 text-muted  fs-6"><i
                                                        class="fa-regular fa-door-open fa-fw me-1 "></i>
                                                    {{$unit->bedrooms_number . ' ' . __('lang.bedrooms') }} </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-5 text-muted "><i class="fa-solid fa-users fa-fw me-1"></i>
                                                    <span class="fs-6">   {{Lang::locale()== 'en' ? $unit->person->name_en :$unit->person->name_ar }} </span>
                                                </div>
                                                <div class="col-3 text-muted p-0 "><i
                                                        class="fa-solid fa-arrows-up-down-left-right fa-fw me-1"></i>
                                                    {{$unit->size . ' ' .__('lang.meter')}}<sup>2</sup> </div>
                                                <div class="col-4 text-nowrap initialism text-muted "><i class="fa-solid fa-house fa-fw me-1"></i>
                                                    <span class="fs-6 "> 
                                                    {{__('lang.unit_type')}} {{Lang::locale()== 'en' ? $unit->type->name_en:$unit->type->name_ar }} </div>
                                                    </span>    
                                                </div>
                                            <hr class="w-25">
                                            <div class="row ">

                                                <div class="col-6 "> <span class=""><i
                                                            class="fa-solid fa-star text-warning"></i> <span
                                                            class="fw-bold">{{$unit->avarage_rating}}</span> <span class="text-muted">
                                                            ({{$unit->total_rating}})</span></span> </div>
                                                <div class="col-6 d-flex justify-content-end text-muted"><span
                                                        class=" fw-bolder text-main me-1">
                                                        {{$unit->price}} {{__('lang.currency') }} </span> /
                                                    {{__('lang.night')}}</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $card_num++;?>
                    @endforeach
                </div>
                <div class="col-xl-5 col-12 d-lg-block d-none">
                    <div wire:ignore id="map" class=" rounded-lg is-sticky"></div>
                </div>

                <div class="text-center my-5">
                    {{ $units->links('pagination-links') }}
                </div>
            </div>

            @endif
        </div>
    </div>
    <!-- end main container  -->

    <?php

$x=[];
foreach ($units as $unit) {
    $x[]= array(
    $unit->price.' '.__('lang.currency'),
    $unit->lat,
    $unit->long,
    $unit->html
    );
}



?>
    {{-- {{dd($units)}} --}}
    @if(count($units)>0)
    <script type="text/javascript">
        function loadMap() {
            
            
            // Your JS here.
            var smoothPanInterval;

            function initMap(lat ={{$units[0]['lat']}}, lng = {{$units[0]['long']}}, zoom = 9) {
                var map = new google.maps.Map(document.getElementById("map"), {
                    center: { lat, lng },
                    zoom: zoom,
                    // mapTypeId: "satellite",
                });

  
                var locationDivs = document.getElementsByClassName("location-div");
                Array.from(locationDivs).forEach((div) => {
                    div.addEventListener("mouseover", function () {
                        var lat = parseFloat(this.getAttribute("data-lat"));
                        var lng = parseFloat(this.getAttribute("data-lng"));
                        cancelSmoothPan();
                        smoothPanTo(map, lat, lng, 12);
                    });
                });

                var locations = <?php echo json_encode($x) ?>;
                var infowindow = new google.maps.InfoWindow();
                var marker , i;
        
                for (i = 0; i < locations.length; i++) {
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        animation: google.maps.Animation.DROP,
                        icon: "../home-assets/common_images/tag.png",
                        label: {
                            text: locations[i][0],
                            color: '#006cad',
                            fontSize: '15px',
                            fontWeight: 'bold',
                        },
                        map: map
                    });

                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                        return function () {
                            marker.setIcon("../home-assets/common_images/active-tag.png");
                            var label = marker.getLabel();
                            label.color = "white";
                            marker.setLabel(label);
                            infowindow.setContent(locations[i][3]);
                            infowindow.open(map, marker);
                        };
                    })(marker, i));
                }
            }

            function smoothPanTo(map, lat, lng, zoom) {
                var currentLat = map.getCenter().lat();
                var currentLng = map.getCenter().lng();
                var currentZoom = map.getZoom();

                var deltaLat = (lat - currentLat) / 100;
                var deltaLng = (lng - currentLng) / 100;
                var deltaZoom = (zoom - currentZoom) / 100;

                smoothPanInterval = setInterval(function () {
                    var newLat = map.getCenter().lat() + deltaLat;
                    var newLng = map.getCenter().lng() + deltaLng;
                    var newZoom = map.getZoom() + deltaZoom;

                    map.setCenter({ lat: newLat, lng: newLng });
                    map.setZoom(newZoom);

                    if (Math.abs(newLat - lat) < Math.abs(deltaLat) || Math.abs(newLng - lng) < Math.abs(deltaLng)) {
                        cancelSmoothPan();
                        map.setCenter({ lat, lng });
                        map.setZoom(zoom);
                    }
                }, 10);
            }

            function cancelSmoothPan() {
                if (smoothPanInterval) {
                    clearInterval(smoothPanInterval);
                    smoothPanInterval = null;
                }
            }

            window.initMap = initMap;
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://maps.google.com/maps/api/js?key={{env('MAP_API_KEY')}}&callback=initMap&language=<?=Lang::locale()?>';
            document.head.appendChild(script);
        }

        loadMap();
        window.livewire.on('bedroomUpdated', loadMap);
    </script>
    @endif

</div>