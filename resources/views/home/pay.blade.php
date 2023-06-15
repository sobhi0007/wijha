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
                                    src="https://images.pexels.com/photos/6373478/pexels-photo-6373478.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                    alt="" srcset="">
                            </div>
                            <div class="col-6">
                                <div class="col-12 text-muted mt-2">{{$unit->title}} </div>
                                <div class="col-12 fw-bold my-2">The Lounge & Bar</div>
                                <div class="col-12 text-muted my-2">2 beds · 2 baths</div>
                                <hr width="25%">
                                <div class="col-12">
                                    <span class=""><i class="fa-solid fa-star text-warning"></i> <span
                                            class="fw-bold">5.0</span> <span class="text-muted"> (28)</span></span>
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
    publishable_api_key: 'pk_test_cqBiwsU7vraYm9eYRt9zeRoBhMN96k78jPNQD75B',
    callback_url: 'http://127.0.0.1:8000/pay',
    methods: ['creditcard','stcpay'],
  })
</script>
@endsection