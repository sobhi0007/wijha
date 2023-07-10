@extends('layouts.home')


@section('content')

 <!-- lightbox -->
 <link rel="stylesheet" href="{{asset('assets/lightbox/dist/css/lightbox.min.css')}}">

<div class="container-fluid px-md-5  " >

    <div class="row ">
        <div class="col-md-6 col-8 p-1"   data-aos="fade-right">
             <a class="gallary" href="{{$unit->image[0]}}" data-lightbox="example-set" ><img   height="100%" width="100%"   class="  rounded-lg " src="{{$unit->image[0]}}" alt=""/></a>
        </div>
        <div class="col-md-6 col-4" data-aos="fade-left">
            <div class="row ">

                <?php $count=0; ?>
                @foreach ($unit->image as $key=>$image) 
                    @if ($key!=0  )
                        @if ($count <= 4)
                        <div class="col-md-6 col-12  p-1 " >
                            <a class="gallary " href="{{$image}}" data-lightbox="example-set" ><img    height="100%" width="100%" class="  rounded-lg" src="{{$image}}" alt="" /></a>
                        </div>
                        @else
                        <div class="col-md-6 col-12  p-1 "hidden >
                            <a class="gallary " href="{{$image}}" data-lightbox="example-set" ><img    height="100%" width="100%" class="  rounded-lg" src="{{$image}}" alt="" /></a>
                        </div>
                        @endif
                    @endif 
                    @php
                     $count++;   
                    @endphp
                @endforeach

 
    
        
    
               
            </div>
    
    
        </div>
    </div>
           
                  </div>
    
    
        <!-- main container -->
            <div class="container-fluid px-md-5 mt-5" >
               
                <div class="row ">
                    <div class="col-md-8 col-12 ">
                        <div class="row " >
                            <div class="col-12">
                                <div class="card mb-3 rounded-lg col-12  overflow-hidden " > 
                                    <div class="row g-0">
                                    <div class="col-md-12">
                                        <div class="card-body p-4">
                                            <span class="rounded-pill bg-custom-primary text-primary text-s py-1 px-2 fs-6 fw-bold ">Wooden house</span>
                                        <h2 class="fw-bold mt-4">{{$unit->title}}</h2>
                                       
                                        <div class="row  mt-4">
                                            <div class=" ">
                                                <span class=""><i class="fa-solid fa-star text-warning"></i> <span class="fw-bold">{{$unit->avarage_rating}}</span> <span class="text-muted"> ({{$unit->total_rating}})</span></span> 
                                                <span class="mx-2"> . </span> 
                                                <span><img src="{{asset('assets/images/pin_orange.png')}} " width="20px" alt="" srcset=""> {{$city}} </span>
                                            </div>
                                            <div class=" mt-4 ">
                                                <img src="{{asset('assets/images/user.png')}}" width="40px" class="rounded-circle" alt="" srcset="">
                                                <span class="ms-2 text-muted fw-bold ">{{__('lang.hosted_by')}}</span>
                                                <span  class="fw-bolder ">  {{$user->name}}</span>
                                            </div>
                                        </div>
                                        <hr class="my-4">
                                            <div class="row mb-2">
                                                <div class="col-4 text-muted "><i class="fa-regular fa-user fa-fw me-1"></i> 6 guests</div>
                                                <div class="col-4 text-muted "><i class="fa-regular fa-bath fa-fw me-1 "></i> 3 baths</div>
                                                <div class="col-4 text-muted "><i class="fa-regular fa-door-open fa-fw me-1 "></i> 6 bedrooms </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4 text-muted "><i class="fa-solid fa-bed fa-fw me-1"></i> 6 beds</div>
                                                <div class="col-4 text-muted "><i class="fa-solid fa-ban-smoking fa-fw me-1 "></i> No smoking</div>
                                                <div class="col-4 text-muted "><i class="fa-solid fa-wifi fa-fw me-1 "></i> Wifi</div>
                                            </div>
                                          
                                        </div>
                                    </div>
                                    </div> 
                                    
                                    
                                    
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card mb-3 rounded-lg col-12  overflow-hidden "> 
                                    <div class="row g-0">
                                    <div class="col-md-12">
                                        <div class="card-body p-4">
                                            <h2 class="fw-bold mt-4">  {{__('lang.information')}}</h2>
                                       <hr width="10%">
                                      <div class="text-muted mb-4" >{{$unit->description}} </div>
                                         </div>
                                    </div>
                                </div> 
                            </div>
                            </div>
                            <div class="col-12 " hidden>
                                <div class="card mb-3 rounded-lg col-12  overflow-hidden " > 
                                    <div class="row g-0">
                                    <div class="col-md-12">
                                        <div class="card-body p-4">
                                            <h2 class="fw-bold mt-4"> Amenities</h2>
                                            <span class="text-muted">About the property's amenities and services</span>
                                       <hr width="10%">
                                       <div class="row my-4">
                                        <div class="col-4 text-muted "><i class="fa-regular fa-user fa-fw me-1"></i> 6 guests</div>
                                        <div class="col-4 text-muted "><i class="fa-regular fa-bath fa-fw me-1 "></i> 3 baths</div>
                                        <div class="col-4 text-muted "><i class="fa-regular fa-door-open fa-fw me-1 "></i> 6 bedrooms </div>
                                    </div>
                                    <div class="row my-4">
                                        <div class="col-4 text-muted "><i class="fa-solid fa-bed fa-fw me-1"></i> 6 beds</div>
                                        <div class="col-4 text-muted "><i class="fa-solid fa-ban-smoking fa-fw me-1 "></i> No smoking</div>
                                        <div class="col-4 text-muted "><i class="fa-solid fa-wifi fa-fw me-1 "></i> Wifi</div>
                                    </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            </div>
                            <div class="col-12" hidden>
                                <div class="card mb-3 rounded-lg col-12  overflow-hidden "> 
                                    <div class="row g-0">
                                    <div class="col-md-12">
                                        <div class="card-body p-4">
                                            <h2 class="fw-bold mt-4"> Room Rates</h2>
                                            <span class="text-muted">Prices may increase on weekends or holidays</span>
                                       <hr width="10%">
                                      <div class="row">
                                        <div class="col-12">
                                            <div class="row stripped-rows py-3  rounded text-muted fw-bold ">
                                                <div class="col-6 ">Monday - Thursday</div>
                                                <div class="col-6 text-end ">$199</div>
                                            </div>
                                            <div class="row stripped-rows py-3  rounded text-muted fw-bold ">
                                                <div class="col-6 ">Friday - Sunday</div>
                                                <div class="col-6 text-end ">$255</div>
                                            </div>
                                            <div class="row stripped-rows py-3  rounded text-muted fw-bold ">
                                                <div class="col-6 ">Sunday - Monday</div>
                                                <div class="col-6 text-end ">$255</div>
                                            </div>
                                            <div class="row stripped-rows py-3 rounded text-muted fw-bold ">
                                                <div class="col-6 ">Rent by month</div>
                                                <div class="col-6 text-end ">-8.34 %</div>
                                            </div>
                                            <div class="row stripped-rows py-3 rounded text-muted fw-bold ">
                                                <div class="col-6 ">1 night</div>
                                                <div class="col-6 text-end ">$199</div>
                                            </div>
                                            <div class="row stripped-rows py-3 rounded text-muted fw-bold ">
                                                <div class="col-6 ">Max number of nights</div>
                                                <div class="col-6 text-end ">90 nights</div>
                                            </div>
    
                                        </div>
                                      </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            </div>
                            <div class="col-12">
                                <div class="card mb-3 rounded-lg col-12  overflow-hidden " > 
                                    <div class="row g-0">
                                    <div class="col-md-12">
                                        <div class="card-body p-4">
                                          <h2 class="fw-bold mt-4"> {{__('lang.host_Information')}}</h2>
                                          <hr width="10%" class="my-4">
                                                                                                      
                                        <div class="row  my-4">
                                            <div class=" mt-4  ">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-2"> <img src="{{asset('assets/images/user.png')}}" width="50px" class="rounded-circle" alt="" srcset="">
                                                        </div>
                                                        <div class="col-10 "> 
                                                            <div>
                                                                <span  class="fw-bolder h5 ">{{$user->name}}</span>
                                                            </div>
                                                            <span class=" text-muted "><i class="fa-solid fa-star text-warning"></i> <span class="fw-bold">{{$unit->avarage_rating}}</span> <span class="text-muted"> ({{$unit->total_rating}})</span></span> 
                                                            <span class="mx-2 text-muted"> . </span> 
                                                            <span   class="text-muted"> 2 {{__('lang.places')}} </span>
                                                          
                                                        </div>
                                                    </div>  
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <span class="text-muted fw-bold">Providing lake views, The Symphony 9 Tam Coc in Ninh Binh provides accommodation, an outdoor swimming pool, a bar, a shared lounge, a garden and barbecue facilities.</span>
                                                    
                                        
                                            <div class="row my-4">
                                                <div class="col-12 text-muted my-1 "><i class="fa-regular fa-calendar fa-fw me-1 "></i> Joined in March 2016</div>
                                                <div class="col-12 text-muted my-1 "><i class="fa-solid fa-message fa-fw me-1"></i> Response rate - 100%</div>
                                                <div class="col-12 text-muted my-1 "><i class="fa-solid fa-clock fa-fw me-1"></i> Fast response - within a few hours </div>
                                            </div>
                                            <hr class="my-4 " width="10%">
    
                                            <a href="#" class="btn btn-dark border rounded-lg py-2 px-4">Show host profile</a>
    
                                        </div>
                                    </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="col-12 ">
                                <div class="card mb-3 rounded-lg col-12  overflow-hidden " > 
                                    <div class="row g-0">
                                    <div class="col-md-12 mb-1">
                                        <div class="card-body p-4">
                                            <h4 class="fw-bold mt-4"> {{__('lang.reviews')}} ( {{$unit->reviews->count()}} )</h4>
                                         <hr width="10% ">
                                        </div>
                                    </div>
                                  @forelse ($unit->reviews as $review)
                                  <div class="row mx-1 ">
                                    <div class="col-1">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRY3QVTWT0lrSx73oXNEjgAZV-npePWU0la-TD57prRrQ-ONw_BpVq-ketNJ7Jb-7uLZ2w&usqp=CAU" class="rounded-circle" width="50px" alt="" srcset="">
                                    </div>
                                    <div class="col-11">
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="fw-bold m-0 h6" >{{$review->booking->user->name}}</p>
                                                <p class="text-muted h6 ">{{Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</p>
                                            </div>
                                            <div class="col-6 text-end">
                                                @for($i = 1; $i <= 5; $i++)
                                                   <span><i class="fa-solid fa-star {{$review->overall_rating >= $i ? 'text-warning':'text-secondary'}}"></i></span> 
                                                @endfor
                                               
                                              
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-muted fw-bold">
                                               {{$review->review}}
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="text-muted my-5">
                                </div>   
                                  @empty
                                  <div class="d-flex justify-content-center my-3">
                                    {{__('lang.no_reviews_yet')}}
                                  </div>
                                    
                                  @endforelse
                                  
                                </div> 
                            </div>
                        </div>
    
                            
                        </div>
                    </div>
                    <div class="col-md-4 col-12">  
                        <div  class="  is-sticky ">
                            <div class="card rounded-lg col-12" >
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-8"><span class="fw-bold h3">{{$unit->price}} {{__('lang.currency')}}</span><span class="text-muted h6"> /{{__('lang.night')}}</span></div>
                                        <div class="col-4 text-end"> 
                                            <span class=""><i class="fa-solid fa-star text-warning"></i> <span class="fw-bold">{{$unit->avarage_rating}}</span> <span class="text-muted"> ({{$unit->total_rating}})</span></span> 
                                        </div>
                                    </div>
                            <form action="{{route('reservation')}}" method="GET">
                                @csrf
                                @method('GET')
                                <input type="hidden" name="unit" value="{{$unit->code}}">
                                <div>    
                                    <div class=" my-5 @if (Lang::locale()=='ar') row justify-content-md-center @endif" @if (Lang::locale()=='ar')dir="ltr"@endif>
                                        <div class="t-datepicker ">
                                            <div class="{{Lang::locale()=='ar' ?'t-check-out col-6 mb-3 mb-sm-0':'t-check-in  col-6  mb-3 mb-sm-0'}}" ></div>
                                            <div class="{{Lang::locale()=='en' ?'t-check-out col-6 mb-3 mb-sm-0':'t-check-in  col-6  mb-3 mb-sm-0'}}" ></div>
                                        </div>
                                    </div>    
                                </div>
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                  <div class="row pt-5">
                                    <div class="col-6"><span class="text-muted h6">
                                        <span id="price">{{$unit->price}}</span>
                                         {{__('lang.currency')}} 
                                           @if (Lang::locale()=='en')  x <span id="totalDays">{{ session()->has('days') ? session('days') : 1 }}</span> @endif 
                                           @if (Lang::locale()=='ar')  <i class="fa fa-close"></i>  
                                           <span id="totalDays">{{ session()->has('days') ? session('days') : 1 }}</span> @endif  {{ __('lang.night')}}</span>
                                    </div>
                                    <div class="col-6 text-end">  <span class="text-muted h6" id="total">{{ session()->has('total_price') ? session('total_price') : $unit->price }} {{__('lang.currency')}}</span> </div>
                                    
                                  </div>
                                  <div class="row mt-2">
                                    <div class="col-6"><span class="text-muted h6"> {{__('lang.service_charge')}}</span></div>
                                    <div class="col-6 text-end">  <span class="text-muted h6">0 {{__('lang.currency')}}</span> </div>
                                  </div>
    
                                  <hr>
                                  <div class="row mt-2">
                                    <div class="col-6"><span class="fw-bold h6" > {{__('lang.total_price')}}</span></div>
                                    <div class="col-6 text-end">  <span class="fw-bold h6 " id="grandTotal">{{ session()->has('total_price') ? session('total_price') : $unit->price }} {{__('lang.currency')}}</span> </div>
                                  </div>
    
                                  <div class="mt-4">
                                    <button type="submit" class="btn bg-main text-light rounded-lg d-block fw-bold">{{__('lang.reserve')}}</button>
                                  </div>
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <!-- end main container  -->
 <!-- lightbox js -->
 <script src="{{asset('assets/lightbox/dist/js/lightbox-plus-jquery.min.js')}}"></script>
@if(Lang::locale()=='ar')
<script>
    // datepicker options
     $(document).ready(function(){

        // Call global the function
        $('.t-datepicker').tDatePicker({
        dateCheckIn:'{{ session()->has('check_in') ? session('check_in') : null }}',
        dateCheckOut:'{{ session()->has('check_out') ? session('check_out'): null }}',
        dateDisabled:{!! json_encode($dateRanges) !!}.split(','),
        iconDate: '<i class="fa-regular fa-calendar text-muted h5 "></i>',
        arrowPrev: '<i class="fa fa-chevron-left"></i>',
        titleDays: ['الاثنين','الثلاثاء','الاربعاء','الخميس','الجمعه','السبت','الاحد'],
        arrowNext: '<i class="fa fa-chevron-right"></i>',
        numCalendar    :   1,
        titleCheckIn: 'موعد الوصول',
        titleDateRanges: 'ليال',
        titleMonths: ['يناير','فبراير','مارس','ابريل','مايو','يونيو','يوليو','اغسطس','سيبتمبر','اكتوبر','نوفمبر','ديسمبر'],
        titleDateRange: 'ليله',
        titleToday: 'الليله',
        titleCheckOut: 'موعد المغادرة',
        language:"en-AU" ,
        // startDate: '2023-05-13',
        // endDate: '2023-05-18',
        // daysOfWeekHighlighted: [6,7],
        });
      });</script>
@else 
<script>
     $(document).ready(function(){
      // Call global the function
      $('.t-datepicker').tDatePicker({
        iconDate: '<i class="fa-regular fa-calendar text-muted h5 "></i>',
        // dateDisabled: ['2023-05-13','2023-05-14','2023-05-15','2023-05-16','2023-05-17','2023-05-18'],    
        dateCheckIn:'{{ session()->has('check_in') ? session('check_in') : null }}',
        dateCheckOut:'{{ session()->has('check_out') ? session('check_out'): null }}',
        arrowPrev: '<i class="fa fa-chevron-left"></i>',
        numCalendar    :   1,
        arrowNext: '<i class="fa fa-chevron-right"></i>',

  
      });
    });
</script>
@endif
@endsection