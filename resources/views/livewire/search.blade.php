
        <input type="text" name="location"
        wire:model="search"
          class="form-control @error('location') is-invalid @enderror rounded-lg py-2 input-lg shadow"
          placeholder="{{__('lang.serach_location')}}">

          @foreach ($cities as $city)
              {{$city->name_ar}}
          @endforeach
      </div>
     