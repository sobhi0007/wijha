@extends('layouts.home')

@section('content')
<div>


    <div class="container-fluid px-md-4 mt-5">
        <div class="row  justify-content-center">
            <div class="row ">
   
                <div class="">
                    <div class="alert alert-danger alert-dismissible fade show col-12" role="alert" wire:offline>
                    <strong>You are now offline !</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <h1>{{__('lang.owner_units')}} {{ $owner->name }}</h1>
                    <p class="text-muted fw-bold"> {{__('lang.unit_count')}} {{$units->count()}} <span class="mx-2">
                    </p>
                 
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

                {{-- <div class="text-center my-5">
                    {{ $units->links('pagination-links') }}
                </div> --}}
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
@endsection