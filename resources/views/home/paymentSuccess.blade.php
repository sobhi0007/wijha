@extends('layouts.home')

@section('content')
 
<div class="container-fluid py-5">
    <div class="row justify-content-center">
      <div class="col-md-12 ">
        <div class=" text-center">
          <div class="card-body">
            <img src="{{asset('assets/images/success.png')}}" alt="" srcset="">
            <h1 class="display-4">{{__('lang.payment_success')}}</h1>
            <p class="lead">{{__('lang.payment_success_message')}}</p>
          </div>
         
        </div>
      </div>
    </div>
  </div>
  
@endsection