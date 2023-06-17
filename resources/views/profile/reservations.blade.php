<x-app-layout>

    
        <div class="mx-lg-5 mx-2 my-3">
        
                <div class=""><h3>{{__('lang.reservations')}}</h3>  <hr class="title-hr" ></div>
                <div class="p-6 text-gray-900">
                    @php
                    $card_num=1;
                    @endphp
                    @forelse ($bookings as $booking)

                    {{-- start --}}
                   

                        <div class="col-12">
                            <div class="card mb-3 rounded-lg col-12 custom-shadow overflow-hidden location-div "
                                data-lat="{{$booking->unit->lat}}" data-lng="{{$booking->unit->long}}">
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

                                                    @foreach ($booking->unit->getMedia('images') as $image)
                                                    <button type="button"
                                                        data-bs-target="#carouselExampleIndicators{{$card_num}}"
                                                        data-bs-slide-to="{{$img_num}}"
                                                        class="{{$img_num == 0 ?'active':''}}"
                                                        aria-current="{{$img_num == 0 ?'true':''}}"
                                                        aria-label="Slide {{$img_num}}"></button>
                                                    <?php $img_num++; ?>
                                                    @endforeach

                                                </div>
                                                <div class="carousel-inner "
                                                    style="width:100%; height: 250px !important;">
                                                    @livewire('wishlist-units', ['color' =>
                                                    in_array($booking->unit->code, $wishlists)? 'text-danger
                                                    ':'text-light fa-beat-fade' ,'unit_id'=>$booking->unit->code ])
                                                    @foreach ($booking->unit->getMedia('images') as $key=>$image)
                                                    <div class="carousel-item {{$key == 0 ? 'active':''}} ">
                                                        <img src="{{$image->getFullUrl()}}" class="d-block w-100"
                                                            alt="...">
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
                                        <a href="{{route('unit.show',$booking->unit->code)}}"
                                            class="text-decoration-none text-dark">
                                            <div class="card-body">

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
                                                        <p class="card-text d-inline "><span
                                                                class="text-muted">{{__('lang.from')}} </span>
                                                            <strong class="text-main"> {{$booking->from_datetime}}
                                                            </strong>
                                                        </p>
                                                    </div>
                                                    <div class="col-4">
                                                        <p class="card-text d-inline "><span
                                                                class="text-muted">{{__('lang.to')}} </span>
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
                                                                {{$daysBetween >2 && $daysBetween <=10?__('lang.nights'):__('lang.night')}}</span>
                                                        </p>

                                                    </div>

                                                </div>
                                                <div class="row mb-2">


                                                    <div class="col-12">
                                                        <p class="card-text d-inline ">
                                                            <span class="text-muted">{{__('lang.total_price')}} {{__('lang.in') .' ' . $daysBetween }}
                                                                {{$daysBetween >2 && $daysBetween <=10?__('lang.nights'):__('lang.night')}} </span>
                                                            <strong class="text-main">{{number_format(floatval($booking->total_price), 0, '.', '').' '.
                                                                __('lang.currency')}}</strong>
                                                        </p>

                                                    </div>


                                                </div>
                                                <hr class="w-25">
                                                <div class="row ">

                                                    <div class="col-6 "> <span class=""><i
                                                                class="fa-solid fa-star text-warning"></i> <span
                                                                class="fw-bold">5</span> <span class="text-muted">
                                                                (0)</span></span> </div>
                                                    <div class="col-6 d-flex justify-content-end text-muted"><span
                                                            class=" fw-bolder text-main me-1">
                                                            {{$booking->unit->price}} {{__('lang.currency') }} </span> /
                                                        {{__('lang.night')}}</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $card_num++;?>

                  

                    {{-- end --}}
                    @empty
                    <div class=" text-center">
                        <div class="row  d-flex justify-content-center">
                            <div class="col-12  d-flex justify-content-center">
                                <img src="{{asset('assets/images/no_bookings.jpg')}}" class="w-50">
                            </div>
                            <div class="col-12 mt-1">
                                <h4 class="fw-bold">{{__('messages.no_bookings_title')}}</h4>
                            </div>
                            <div class="col-10  d-flex justify-content-center">
                                <p class="text-secondary  ">{{__('messages.no_bookings_body')}}</p>
                            </div>
                        </div>
                        <div class=" py-3  py-md-0  d-flex justify-content-center" >
                            <a href="/"  class="btn col-md-4 col-12 rounded-lg bg-main text-light"> <i class="fas fa-earth"></i>
                              {{__('lang.explore_now')}} </a>
                    
                          </div>
                    </div>
                    @endforelse
                </div>
        </div>

</x-app-layout>