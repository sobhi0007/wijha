<div>
   
    <div class="my-5">
        @foreach ($cities as $city)
               <button wire:click="getCity('{{$city->slug}}')" href="" class="btn my-2 mx-3 {{$btn == $city->slug ? 'bg-main  text-light':'bg-white  text-dark' }}  me-3 rounded-lg px-4">   {{$city->name}}</button>
        @endforeach
    </div>

        <div class="row"> 
          <?php $counter=0?>
        @foreach ($units as $unit)
        <div class="col-12 col-md-6 col-lg-3 mb-4 "  >
         
            <div class="card rounded-lg" >
              <a href="{{route('unit.show',$unit->code)}}" class="text-decoration-none text-dark">
                <div id="carouselExampleIndicators{{$counter}}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php $count=0;?>
                        @foreach ($unit->img as $key)
                        <button type="button" data-bs-target="#carouselExampleCaptions{{$counter}}" data-bs-slide-to="{{$count}}" class="{{$count==0?'active':''}}" aria-current="{{$count==0?'true':''}}" aria-label="Slide 1"></button>
                        <?php $count++;?>
                        @endforeach
                    
                    </div>
                    <div class="carousel-inner rounded-lg border-bottom-0" style="width:100%; height: 200px !important;border-radius: 10px 10px 0 0 !important;">
                      {{-- @auth
                      @livewire('wishlist-units', ['color' =>
                              in_array($unit->code, $wishlists)? 'text-danger
                              ':'text-light fa-beat-fade' ,'unit_id'=>$unit->code ])
                      @endAuth --}}

                      @foreach ($unit->img as $key=>$image)
                      <div class="carousel-item {{$key == 0 ? 'active':''}} ">
                        <img src="{{$image}}" class="d-block w-100" alt="..." >
                      </div>
                      @endforeach
                      
                    
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators{{$counter}}" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators{{$counter}}" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
                <div class="px-3 py-2">
                  
                    <div class="my-2">
                        <span class="rounded-pill bg-custom-success text-success text-xs py-1 px-2 fs-6 mb-2 ">اعلان</span>
                        <h6 class="d-inline">{{$unit->title}}</h6>
                    </div>
                    <div class="my-2">
                        <img src="./assets/images/logos/pin_orange.png" width="20px"alt="" srcset=""> 
                       <span>{{  Str::limit($unit->description,  200) }}..</span>
                    </div>
                    <hr class="w-25">
                    <div class="row ">
                        <div class="col-6">
                          <span class=" fw-bolder text-main">{{$unit->price}}  {{__('lang.currency')}}    </span><span class="text-muted"> /الليله</span></div>
                        <div class="col-6 d-flex justify-content-end"> 
                          <span class="fw-bold">
                            <i class="fa-solid fa-star text-warning"></i> 5 <span class="text-muted">
                               (0)</span>  </div>
                    </div>
                </div>
              </div>
            </a>
            </div>
       
        <?php $counter++?>
        @endforeach
       
       
        <div class="d-flex justify-content-center mt-3">
          <a href="{{route('home.searchresults',['location'=>$btn , 'check_in'=>null,'check_out'=>null])}}" class="btn bg-main rounded-lg text-light">{{__("lang.see_more")}}</a href="{{route('home.searchresults',['location'=>$btn])}}">
        </div>
    </div>
</div>

