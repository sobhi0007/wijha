@extends('layouts.home')

@section('content')



<!-- main container -->
<div class="container-fluid px-md-5 mt-5">

    <div class="row ">
        <div class="col-md-8 col-12 ">

            <div class="card mb-3 rounded-lg col-12  ">
                <div class="row g-0">
                    <div class="col-md-12">
                        <div class="card-body p-4">
                            <h2 class="fw-bold my-4"> {{__('lang.confirm_and_pay')}}</h2>
                            <hr>
                            <div class="mysr-form"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-4 col-12">
            <div class="  is-sticky ">
                <div class="card rounded-lg col-12">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-6">
                                <img class="  rounded-lg w-100" style="max-height: 200px;"
                                    src="{{ $unit->getMedia('images')[0]->getFullUrl()}}"
                                    alt="" srcset="">
                            </div>
                            <div class="col-6">
                                <div class="col-12 text-muted mt-2">{{$unit->title}} </div>
                                <hr width="25%">
                                <div class=" ">
                                            <span class=""><i class="fa-solid fa-star text-warning"></i> <span
                                                    class="fw-bold">{{$unit->avarage_rating}}</span> <span
                                                    class="text-muted"> ({{$unit->total_rating}})</span></span>
                                            <span class="mx-2"> . </span>
                                            <span><img src="{{asset('assets/images/pin_orange.png')}} " width="20px"
                                                    alt="" srcset=""> {{Lang::locale()=='en'?$unit->city->name_en:$unit->city->name_ar}} </span>
                                        </div>
                            </div>
                        </div>

                        <div class="row pt-5">
                            <h3>{{__('lang.price_details')}}</h3>
                            <div class="col-6"><span class="text-muted h6"><span id="price">{{$unit->price}}</span>
                                    {{__('lang.currency')}} @if (Lang::locale()=='en') x <span
                                        id="totalDays">{{$days}}</span> @endif @if (Lang::locale()=='ar') <i
                                        class="fa fa-close"></i> <span id="totalDays">{{$days}}</span> @endif {{
                                    __('lang.night')}}</span></div>
                            <div class="col-6 text-end"> <span class="text-muted h6" id="total">{{$total_price}}
                                    {{__('lang.currency')}}</span> </div>


                        </div>
                        <div class="row mt-2">
                            <div class="col-6"><span class="text-muted h6"> {{__('lang.service_charge')}}</span></div>
                            <div class="col-6 text-end"> <span class="text-muted h6">0 {{__('lang.currency')}}</span>
                            </div>
                        </div>

                        <hr>
                        <div class="row mt-2">
                            <div class="col-6"><span class="fw-bold h6"> {{__('lang.total_price')}}</span></div>
                            <div class="col-6 text-end"> <span class="fw-bold h6 " id="grandTotal">{{$total_price}}
                                    {{__('lang.currency')}}</span> </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end main container  -->

<script>
    Moyasar.init({
    element: '.mysr-form',
    amount: {{$total_price*100}},
    currency: 'SAR',
    description: 'Booking unit',
    publishable_api_key: "{{env('PUBLISHABLE_API_KEY')}}",
    callback_url:  "{{env('APP_URL').'/pay'}}",
    methods: ['creditcard','stcpay'],
  })
</script>
@endsection