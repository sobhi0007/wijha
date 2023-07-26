<x-app-layout>


    <div class="mx-lg-5 mx-2 my-3">

        <div class="">
            <h3>{{__('lang.reservation_details')}}</h3>
            <hr class="title-hr">

            <div class="card mb-3 rounded-lg col-12  overflow-hidden p-4">

                <div class="row">
                    <div class="col-10">
                        <span class="text-muted mb-2">#{{$booking->unit->code}}</span>
                        <h5 class=""> {{$booking->unit->title}}</h5>
                    </div>
                    <div class="col-2">
                        <span class="badge rounded-lg {{$booking->status->color()}}"><i
                                class="{{$booking->status->icon()}}"></i>{{$booking->status->lang()}}</span>
                    </div>
                </div>
                <hr class="w-25">
                <div class="row mb-2">
                    <div class="col-4">
                        <p class="card-text d-inline "><span class="text-muted">{{__('lang.from')}}
                            </span>
                            <strong class="text-main"> {{$booking->from_datetime}}
                            </strong>
                        </p>
                    </div>
                    <div class="col-4">
                        <p class="card-text d-inline "><span class="text-muted">{{__('lang.to')}}
                            </span>
                            <strong class="text-main"> {{$booking->to_datetime}}
                            </strong>
                        </p>
                    </div>
                    <div class="col-4">
                        @php
                        $fromDate = \Carbon\Carbon::parse($booking->from_datetime);
                        $toDate = \Carbon\Carbon::parse($booking->to_datetime);
                        $daysBetween = $toDate->diffInDays($fromDate);
                        @endphp
                        <p class="card-text d-inline ">
                            <strong class="text-main">{{ $daysBetween }}</strong>
                            <span class="text-muted">
                                {{$daysBetween >2 && $daysBetween
                                <=10?__('lang.nights'):__('lang.night')}}</span>
                        </p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <p class="card-text d-inline ">
                            <span class="text-muted">{{__('lang.total_price')}} {{__('lang.in') .' '
                                . $daysBetween }}
                                {{$daysBetween >2 && $daysBetween
                                <=10?__('lang.nights'):__('lang.night')}} </span>
                                    <strong
                                        class="text-main">{{number_format(floatval($booking->total_price),
                                        0, '.', '').' '.
                                        __('lang.currency')}}</strong>
                        </p>
                    </div>
                </div>
                <hr class="w-25">
                <div class="row ">
                 
                    <div class="col-4 "> <span class=""><i
                                class="fa-solid fa-star text-warning"></i> <span
                                class="fw-bold">{{$booking->unit->avarage_rating}}</span> <span class="text-muted">
                                ({{$booking->unit->total_rating}})</span></span>
                               @if (  $booking->status->lang() === App\Enums\BookingStatus::COMPLETED->lang()  && !$booking->review)
                               <a href="#" class="text-primary text-decoration-none" data-bs-toggle="modal"
                               data-bs-target="#staticBackdropRate">
                               {{__('lang.rate.add_rate')}}
                               </a>
                               @endif 
                        
                    </div>
                    
                    <div class="col-4">
                        <!-- Button trigger modal -->

                        <!-- Modal -->
                        <div class="modal fade " id="staticBackdropRate" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1"
                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog ">
                                <form action="{{route('review.submit')}}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" value="{{$booking->unit->code}}" name="code">
                                    <input type="hidden" value="{{$booking->id}}" name="booking">
                                <div class="modal-content rounded-lg">
                                    <button type="button" class="btn-close text-end m-3"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">{{__('lang.rate.title') .' '. $booking->unit->title }} 
                                        </h5>
                                     
                                    </div>
                                    <div class="modal-body ">
                                        <div class="row d-flex justify-content-center">
                                            <div class="d-flex justify-content-center mb-3">
                                                <div class="rate">
                                                <input type="radio" id="star5" name="rate" value="5" />                                                     
                                                <label for="star5"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('lang.rate.5')}}">5 stars</label>
                                                <input type="radio" id="star4" name="rate" value="4" />
                                                <label for="star4"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('lang.rate.4')}}">4 stars</label>
                                                <input type="radio" id="star3" name="rate" value="3" />
                                                <label for="star3"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('lang.rate.3')}}">3 stars</label>
                                                <input type="radio" id="star2" name="rate" value="2" />
                                                <label for="star2"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('lang.rate.2')}}">2 stars</label>
                                                <input type="radio" id="star1" name="rate" value="1" />
                                                <label for="star1"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('lang.rate.1')}}">1 star</label>
                                            </div>
                                            </div>
                                            <div class="col-12 my-3">
                                                    <textarea class="form-control" name="review" rows="4" placeholder="{{__('lang.rate.placeholder')}}" dir="{{Lang::locale() == 'ar'? 'rtl':'ltr'}}" required></textarea>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{__('lang.close')}}</button>
                                        <button type="submit"
                                            class="btn btn-primary">{{__('lang.rate.btn')}}</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>

                    </div>
                    <div class="col-4 d-flex justify-content-end text-muted"><span
                            class=" fw-bolder text-main me-1">
                            {{$booking->unit->price}} {{__('lang.currency') }} </span> /
                        {{__('lang.night')}}
                    </div>
                </div>
            </div>

            <div class="card mb-3 rounded-lg col-12  overflow-hidden p-4">
                <h3 class="fw-bold mt-4"> {{__('lang.host_Information')}}</h3>
                <hr width="10%" class="my-4">

                <div class="row  my-4">
                    <div class=" mt-4  ">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-2"> <img src="{{asset('assets/images/user.png')}}"
                                        width="50px" class="rounded-circle" alt="" srcset="">
                                </div>
                                <div class="col-10 ">
                                    <div>
                                        <span class="fw-bolder h5 ">{{$booking->unit->user->name}}</span>
                                    </div>
                                    <span class=" text-muted "><i
                                            class="fa-solid fa-star text-warning"></i> <span
                                            class="fw-bold">{{$booking->unit->avarage_rating}}</span> <span
                                            class="text-muted">
                                            ({{$booking->unit->total_rating}})</span></span>
                                    <span class="mx-2 text-muted"> . </span>
                                    <span class="text-muted"> 2 {{__('lang.places')}} </span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <span class="text-muted fw-bold">Providing lake views, The Symphony 9 Tam Coc in
                    Ninh Binh provides accommodation, an outdoor swimming pool, a bar, a shared
                    lounge, a garden and barbecue facilities.</span>


                <div class="row my-4">
                    <div class="col-12 text-muted my-1 "><i
                        class="fa fa-envelope fa-fw me-1"></i> <a class="text-decoration-none" href="mailto:{{$booking->unit->user->email}}">{{$booking->unit->user->email}}</a></div>
                    <div class="col-12 text-muted my-1 "><i
                            class="fa-regular fa-calendar fa-fw me-1 "></i> {{__('lang.joined_in')
                        .' ' .Carbon\Carbon::parse($booking->user->created_at)->diffForHumans() }}</div>
                    <div class="col-12 text-muted my-1 "><i
                            class="fa-solid fa-message fa-fw me-1"></i> {{__('lang.response_rate')}} - 100%</div>
                    <div class="col-12 text-muted my-1 "><i
                            class="fa-solid fa-clock fa-fw me-1"></i> {{__('lang.fast_response')}}  </div>
                </div>
                <hr class="my-4 " width="10%">
                
                    <a href="{{route('owner.units',['user'=>$booking->unit->user->id])}}"
                        class="btn bg-main text-light border rounded-lg py-2 w-25 px-4">{{__('lang.explore_owner_units')}}</a>

              
              
            </div>


            <div class="card mb-3 rounded-lg col-12  overflow-hidden p-4">
                <h4 class="fw-bold mt-4"> {{__('lang.location_on_map')}}</h4>
                <hr width="10%" class="my-4">

                <div class="col-12 ">
                    <div class="my-3">
                    <a class="text-decoration-none" href="https://www.google.com/maps?q={{$units[0]['lat']}},{{$units[0]['long']}}">{{__('lang.see_location_on_map')}}</a>
                    </div>
                    <div wire:ignore id="map" class=" rounded-lg is-sticky"></div>
                </div>
            </div>

            <div class="col-12">
                <div class="card mb-3 rounded-lg col-12  overflow-hidden ">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <div class="card-body p-4">
                                <h3 class="fw-bold mt-4"> {{__('lang.information')}}</h3>
                                <hr class="mt-0" width="10%">
                                <div class="text-muted mb-4">{{$booking->unit->description}} </div>
                                <div class="row">
                                    <div>
                                        <h4 class="fw-bold mt-4"> {{__('lang.time_info')}}</h4>
                                        <hr class="mt-0" width="10%">
                                    </div>
                                    <div class="col-6">
                                        <span class="fw-bold mt-4">{{__('lang.arrival_time')}}</span>
                                        <div class="text-muted mb-4 d-inline">{{ Carbon\Carbon::parse($booking->unit->arrival_time)->format('h:i A')}} </div>
                                    </div>
                                    <div class="col-6">
                                        <span class="fw-bold mt-4">{{__('lang.departure_time')}}</span>
                                        <div class="text-muted mb-4 d-inline">{{ Carbon\Carbon::parse($booking->unit->departure_time)->format('h:i A')}} </div>
                                    </div>
                                </div>

                                @if (!empty($booking->unit->unitData->rules))  
                                    <div>
                                        <h4 class="fw-bold mt-5"> {{__('lang.rules')}}</h4>
                                        <hr class="mt-0" width="10%">
                                        <div class="text-muted mb-4">{{$booking->unit->unitData->rules}} </div>
                                    </div>
                                @endif

                                @if (!empty($booking->unit->unitData->arrival_instructions))  
                                    <div>
                                        <h4 class="fw-bold mt-5"> {{__('lang.arrival_instructions')}}</h4>
                                        <hr class="mt-0" width="10%">
                                        <div class="text-muted mb-4">{{$booking->unit->unitData->arrival_instructions}} </div>
                                    </div>
                                @endif

                                @if (!empty($booking->unit->unitData->cancellation_policy))  
                                    <div>
                                        <h4 class="fw-bold mt-5"> {{__('lang.cancellation_policy')}}</h4>
                                        <hr class="mt-0" width="10%">
                                        <div class="text-muted mb-4">{{$booking->unit->unitData->cancellation_policy}} </div>
                                    </div>
                                @endif

                                @if (!empty($booking->unit->unitData->parking_information))  
                                    <div>
                                        <h4 class="fw-bold mt-5"> {{__('lang.parking_information')}}</h4>
                                        <hr class="mt-0" width="10%">
                                        <div class="text-muted mb-4">{{$booking->unit->unitData->parking_information}} </div>
                                    </div>
                                @endif

                                @if (!empty($booking->unit->unitData->wifi_information))  
                                    <div>
                                        <h4 class="fw-bold mt-5"> {{__('lang.wifi_information')}}</h4>
                                        <hr class="mt-0" width="10%">
                                        <div class="text-muted mb-4">{{$booking->unit->unitData->wifi_information}} </div>
                                    </div>
                                @endif

                              </div>
                        </div>
                    </div>
                </div>
            </div>
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
                        animation: google.maps.Animation.BOUNCE,
                      
                        map: map
                    });

                 
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

</x-app-layout>