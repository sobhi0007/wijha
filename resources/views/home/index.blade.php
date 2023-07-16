@extends('layouts.home')


@section('content')

 
    <?php $x=1;?>
    @foreach ($sliders as $slider)
    <style>
    .example-slider .fnc-slide-<?php echo $x; ?> .fnc-slide__inner,
    .example-slider .fnc-slide-<?php echo $x; ?> .fnc-slide__mask-inner {   background-image: url({{ $slider->img }});
    }
    </style>
    <?php $x++;?>
    @endforeach

    




{{-- start --}}
<link href="{{asset('assets/slider/style.css')}}" rel="stylesheet" />
<link href="{{asset('assets/slider/style.scss')}}" rel="stylesheet" />

<div class="demo-cont d-none d-sm-block" >
  <!-- slider start -->
  <div class="fnc-slider example-slider">
    <div class="fnc-slider__slides">
      <!-- slide start -->
      @foreach ($sliders as $slider)
      <div class="fnc-slide m--blend-green m--active-slide">
        <div class="fnc-slide__inner">
          <div class="fnc-slide__mask">
            <div class="fnc-slide__mask-inner"></div>
          </div>
          <div class="fnc-slide__content">
            <h2 class="fnc-slide__heading">
              <div class="fnc-slide__heading-line">
                <span><p>{{ $slider->getTranslation('text', Lang::locale()) }}</p></span>
              </div>
            </h2>
           
            </button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <nav class="fnc-nav" hidden>
      <div class="fnc-nav__bgs">
        <div class="fnc-nav__bg m--navbg-green m--active-nav-bg"></div>
        <div class="fnc-nav__bg m--navbg-dark"></div>
        <div class="fnc-nav__bg m--navbg-red"></div>
        <div class="fnc-nav__bg m--navbg-blue"></div>
      </div>
      <div class="fnc-nav__controls">
        <button class="fnc-nav__control">
          Black Widow
          <span class="fnc-nav__control-progress"></span>
        </button>
        <button class="fnc-nav__control">
          Captain America
          <span class="fnc-nav__control-progress"></span>
        </button>
        <button class="fnc-nav__control">
          Iron Man
          <span class="fnc-nav__control-progress"></span>
        </button>
        <button class="fnc-nav__control">
          Thor
          <span class="fnc-nav__control-progress"></span>
        </button>
      </div>
    </nav>
  </div>
  <!-- slider end -->
</div>

{{-- end --}}
<div class="container mt-2 col-11 col-sm-10 ">

  <link href="{{asset('./assets/css/select.css')}}" rel="stylesheet" />

  <form action="{{route('home.searchresults')}}" method="GET">


    <div class="row rounded-lg border py-4 px-md-2 px-1 shadow">
      <div class="col-12 col-md-4">
        <select class="form-select" required aria-label="Default select example" name="location" id="search">
          <option></option>

          @foreach ($all_cities as $city)
          <option value="{{$city->slug}}">
            @if (Lang::locale()=='ar')
            {{$city->name_ar}}
            @else
            {{$city->name_en}}
            @endif

          </option>
          @endforeach


        </select>
      </div>
      <div class="col-12 col-md-6 py-3  py-md-0 @error('location') is-invalid @enderror">
        <div class="t-datepicker " dir="ltr">
          <div class="{{Lang::locale()=='ar' ?'t-check-out col-6 mb-3 mb-sm-0':'t-check-in  col-6  mb-3 mb-sm-0'}}">
          </div>
          <div class="{{Lang::locale()=='en' ?'t-check-out col-6 mb-3 mb-sm-0':'t-check-in  col-6  mb-3 mb-sm-0'}}">
          </div>

        </div>
      </div>
      <div class="col-12 col-md-2 py-3  py-md-0" dir="ltr">
        <button type="submit" class="btn col-12 col-md-12  rounded-lg bg-main text-light"> <i class="fas fa-search"></i>
          {{__('lang.search')}} </button>

      </div>
    </div>
  </form>
</div>

<div class=" my-4 overflow-hidden">
  <div class=" mx-4 mt-3 mb-5 ps-2" data-aos="fade-left">
    <h3 class="font-weight-bold"> {{__('lang.places_to_stay')}}</h3>
    <h5 class="text-secondary">{{__('lang.section_descriptions')}}</h5>
  </div>
  <div class=" owl-carousel owl-theme">
    @foreach ($cities as $city)
    <a href="/searchresults?location={{$city->slug}}&check_in=null&check_out=null" class="text-decoration-none">
      <div class="item">
        <div class="d-grid justify-items-center" style="justify-items: center;">
          <img loading="lazy" class="w-75 mb-3 rounded-lg-custom col-12 filter" src="{{$city->img}}" alt="" srcset="">
          <div class="col-8">
            <h5 class="text-start  text-dark font-weight-bolder">{{$city->name}}</h5>
            <h6 class="text-start   text-muted  ">{{$city->units_count}} {{__('lang.properties_found')}}</h6>
          </div>
        </div>
      </div>
    </a>
    @endforeach
  </div>
</div>
</div>


<div class="container-fluid px-5 my-5">
  <div class="row align-items-center">
    <div class="col-7 d-none d-md-block" data-aos="fade-up">
      <img loading="lazy" src="{{asset('assets/images/section-2-image-2.png')}}" alt="" srcset="" class="img-fluid">
    </div>
    <div class="col-12 col-md-5">
      <div data-aos="fade-up">
        <h6 class="mb-4 text-muted"><small>{{__('lang.adv_sectioin.title')}}</small> </h6>
        <h1 class="mb-4 mt-2 ">{{__('lang.adv_sectioin.desc')}}</h1>
      </div>

      <div class=" mt-5" data-aos="zoom-in-up">
        <span class=" mb-3 rounded-pill bg-custom-info text-primary  py-1 px-2 fs-6  ">{{__('lang.adv_sectioin.advertising')}}</span>
        <h5 class="fw-bold mt-3"> {{__('lang.adv_sectioin.advertising_title')}}</h5>
        <h6 class="text-muted mt-3 mb-4 ">{{__('lang.adv_sectioin.advertising_desc')}}</h6>
      </div>
      <div class="mt-5" data-aos="zoom-in-up">
        <span class="rounded-pill bg-custom-success text-success py-1 px-2 fs-6  ">{{__('lang.adv_sectioin.offer')}}</span>
        <h5 class="fw-bold mt-3">{{__('lang.adv_sectioin.offer_title')}}</h5>
        <h6 class="text-muted mt-3 mb-3 ">{{__('lang.adv_sectioin.offer_desc')}}</h6>
      </div>
      <div class="mt-5" data-aos="zoom-in-up">
        <span class="  rounded-pill bg-custom-danger text-danger  py-1 px-2 fs-6  ">{{__('lang.adv_sectioin.safety')}}</span>
        <h5 class="fw-bold mt-3">{{__('lang.adv_sectioin.safety_title')}}</h5>
        <h6 class="text-muted mt-3 mb-3 ">{{__('lang.adv_sectioin.safety_desc')}} </h6>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid px-5 my-5  bg-light rounded-lg my-5 py-5">
  <div class="my-5">
    <h1>{{__('lang.awesome_places.title')}}</h1>
    <h5 class="text-muted">{{__('lang.awesome_places.desc')}}</h5>
  </div>

  <div>
    <livewire:show-units />
  </div>



</div>

<div class="container-fluid px-5 my-5">
  <div class="d-flex justify-content-center">
    <h1>{{__('lang.how_it_works.title')}}</h1>
  </div>
  <div class="d-flex justify-content-center text-muted mb-5">
    <h5>{{__('lang.how_it_works.desc')}}</h5>
  </div>
  <div class="row my-4 bg-sec-4">
    <div class="col-sm-4 col-12 text-center">
      <img loading="lazy" src="./assets/images/homepage/section-4-image1.png" class="w-50" alt="" srcset="">
      <div class="my-4 h4">{{__('lang.how_it_works.1_title')}}</div>
      <div class="text-muted h6">{{__('lang.how_it_works.1_desc')}}</div>
    </div>
    <div class="col-sm-4 col-12 text-center">
      <img loading="lazy" src="./assets/images/homepage/section-4-image2.png" class="w-50 mb-lg-3" alt="" srcset="">
      <div class="my-4 h4">{{__('lang.how_it_works.2_title')}}</div>
      <div class="text-muted h6">{{__('lang.how_it_works.2_desc')}}</div>
    </div>
    <div class="col-sm-4 col-12 text-center">
      <img loading="lazy" src="./assets/images/homepage/section-4-image3.png" class="w-50 my-lg-1" alt="" srcset="">
      <div class="my-4 h4">{{__('lang.how_it_works.3_title')}}</div>
      <div class="text-muted h6">{{__('lang.how_it_works.3_desc')}}</div>
    </div>
  </div>
</div>

{{-- <div class="container-fluid px-lg-5 my-5 ">
  <div class="row my-5">
    <div class="col-lg-6 col-12">
      <h1>انضم إلى النشرة الإخبارية لدينا 🎉</h1>
      <div class="text-sm text-muted mb-4">
        اقرأ وشارك وجهات النظر الجديدة حول أي موضوع. نرحب بالجميع.
      </div>
      <div class="my-5">
        <div class=" my-3 "><span class="rounded-pill bg-custom-info text-primary  py-1 px-3  me-2 ">01</span><span
            class="">احصل على المزيد من الخصم</span></div>
        <div class=" my-3 "><span class="rounded-pill bg-custom-danger text-danger  py-1 px-3  me-2">02</span><span
            class="">احصل على مجلات متميزة</span></div>
      </div>


      <form class="d-flex col-8 position-relative">
        <input class="form-control me-2 col-6 rounded-lg" type="email" placeholder="ادخل البريد الالكتروني"
          aria-label="email">
        <button type="submit"
          class="text-dark rounded-circle  bg-main position-absolute  bottom-0 start-5 border-0 py-1 mb-1 me-1 px-2  mt-2 border-none"
          type="submit"><i class="text-light fa-solid fa-arrow-right"></i></button>
      </form>


    </div>

    <div class="col-6">
      <img loading="lazy" src="./assets/images/homepage/section-5-image.png" alt="" srcset="" class="img-fluid">
    </div>

  </div>
</div> --}}


@if (Lang::locale()=='ar')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
  $("#search").select2({
          placeholder:"ابحث عن المدينه ",
          allowClear: true
      });
   
</script>

<script>
  // datepicker options
 $(document).ready(function(){
    // Call global the function
    $('.t-datepicker').tDatePicker({
    iconDate: '<i class="fa-regular fa-calendar text-muted h5 "></i>',
    arrowPrev: '<i class="fa fa-chevron-left"></i>',
    titleDays: ['الاثنين','الثلاثاء','الاربعاء','الخميس','الجمعه','السبت','الاحد'],
    arrowNext: '<i class="fa fa-chevron-right"></i>',
    numCalendar    :   windowSize(),
    titleCheckIn: 'موعد الوصول',
    titleDateRanges: 'ليال',
    titleMonths: ['يناير','فبراير','مارس','ابريل','مايو','يونيو','يوليو','اغسطس','سيبتمبر','اكتوبر','نوفمبر','ديسمبر'],
    titleDateRange: 'ليله',
    titleToday: 'الليله',
    titleCheckOut: 'موعد المغادرة',
    language:"en-AU" ,
    startDate: '',
    endDate: '',
    });
  });
</script>

@else
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>

<script>
  function windowSize(){

if (window.matchMedia('screen and (max-width: 572px)').matches) {

  return 1
}else if (window.matchMedia('screen and (max-width: 792px)').matches) {

    return 1
}else if(window.matchMedia('screen and (max-width: 992px)').matches) {

    return 1
}else if (window.matchMedia('screen and (max-width: 1200px )').matches){

}else{
 
    return 2
}
}

window.addEventListener('windowSize', windowSize);
windowSize();
   $(document).ready(function(){
      // Call global the function
      $('.t-datepicker').tDatePicker({
     iconDate: '<i class="fa-regular fa-calendar text-muted h5 "></i>',
  
     arrowPrev: '<i class="fa fa-chevron-left"></i>',
     numCalendar    :   windowSize(),
     arrowNext: '<i class="fa fa-chevron-right"></i>',
     
  
      });
    });
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
  $("#search").select2({
        placeholder:"Search by city ",
        allowClear: true
    });
 
</script>
@endif

<script src="{{asset('assets/slider/script.js')}}"></script>
@endsection