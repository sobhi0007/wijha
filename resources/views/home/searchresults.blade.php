@extends('layouts.home')

@section('content')
  <div>

    <livewire:search-result :check_in="$check_in" :check_out="$check_out"  :location="$location"/>
  </div>
@endsection