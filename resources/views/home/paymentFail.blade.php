@extends('layouts.home')

@section('content')
 
<div class="container-fluid py-5">
    <div class="row justify-content-center">
      <div class="col-md-12 ">
        <div class=" text-center">
          <div class="card-body">
            <img src="{{asset('assets/images/fail.png')}}" alt="" srcset="">
            <h1 class="display-4">{{__('lang.payment_fail')}}</h1>
            <p class="lead">{{__('lang.payment_fail_message')}}</p>
          </div>
          <div class=" text-muted">
            <a href="{{route('unit.show',[Session::get('unit')])}}" class="btn btn-success">{{__('lang.try_again')}} </a>
            <a href="{{route('message.index')}}" class="btn btn-danger">{{__('lang.contact_us')}} </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
@endsection