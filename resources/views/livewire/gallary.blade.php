<div class="row">
    @foreach ($unit->getMedia('images') as $image)
    <div class="col-12 col-md-4 my-4 @if(in_array($image->id, $deleted)) {{'d-none'}} @endif "  >
        <div class=" bg-danger shadow border p-2 mt-2 border-danger rounded-circle position-absolute "
            style="right: 10%; z-index:1" wire:click='delete({{$image->id}})'>
            <i class="fa fa-trash font-weight-bolder text-light" aria-hidden="true"></i>
        </div>
        <a href="{{$image->getFullUrl()}}" target="_blank">
            <img src="{{$image->getFullUrl()}}" alt="" class=" w-100 img-fluied  shadow-lg rounded-lg">
        </a>
    </div>
    @endforeach
</div>