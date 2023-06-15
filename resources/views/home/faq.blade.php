@extends('layouts.home')


@section('content')

<div class=" container my-5">
  <h3>{{__('lang.faqs')}}</h3>
  <hr class="title-hr">

  <div class="accordion d-block " id="accordionExample">
    @php
    $i=0;
    @endphp
    @foreach ($faqs as $faq)
    <div class="accordion-item">
      <h2 class="accordion-header" id="heading{{$i}}"> <button class="accordion-button collapsed" type="button"
          data-bs-toggle="collapse" data-bs-target="#collapse{{$i}}" aria-expanded="false"
          aria-controls="collapse{{$i}}">
          {{$faq->question}} </button> </h2>
      <div id="collapse{{$i}}" class="accordion-collapse collapse" aria-labelledby="heading{{$i}}"
        data-bs-parent="#accordionExample">
        <div class="accordion-body"> <strong>{{$faq->answer}}</strong> </div>
      </div>
    </div>
    @php
    $i++;
    @endphp
    @endforeach

  </div>
</div>
@endsection