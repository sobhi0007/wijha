<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                @forelse ($bookings as $booking)
                
                
                <div class="card shadow col-12 my-3 border rounded-lg col-12 custom-shadow" >
                    <div class="card-body m-3">



                        <div class="row">
                            <div class="col-12 my-2">
                                <p class=" fw-bolder">{{$booking->unit->title}}</p>
                            </div>                           
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <p class="card-text d-inline ">{{__('lang.from')}} <strong> {{$booking->from_datetime}} </strong></p>
                            </div>  
                            <div class="col-2">
                                <p class="card-text d-inline ">{{__('lang.to')}} <strong> {{$booking->to_datetime}} </strong></p>
                            </div> 
                            
                            <div class="col-2">
                                <span class="badge rounded-lg {{$booking->status->color()}}"><i class="{{$booking->status->icon()}}"></i>{{$booking->status->lang()}}</span>
                            </div>   
                            
                            <div class="col-2">
                                <p class="card-text d-inline ">{{$booking->total_price.' '. __('lang.currency')}}</p>

                            </div>

                            <div class="col-2">
                                @php
                                $fromDate = \Carbon\Carbon::parse($booking->from_datetime);
                                $toDate = \Carbon\Carbon::parse($booking->to_datetime);
                                $daysBetween = $toDate->diffInDays($fromDate);
                            @endphp
                            
                            <p class="card-text d-inline ">{{ $daysBetween }} {{$daysBetween!=1?__('lang.nights'):__('lang.night')}}</p>
                              
                            </div>
                        </div>

                     
                
                   </div>
                </div>


                @empty

                @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
