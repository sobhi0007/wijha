{{-- MODIFICATIONS FROM HERE --}}
<div class="row">
    <div class="form-group col-12 col-md-4">
        <label class="form-label">{{ __('lang.name') }}</label>
        <p class="border form-control">{{$message->name ?? '--'}}</p>
    </div>

    <div class="form-group col-12 col-md-4">
        <label class="form-label">{{ __('lang.email') }}</label>
        <p class="border form-control">{{$message->email ?? '--'}}</p>
    </div>

    <div class="form-group col-12 col-md-4">
        <label class="form-label">{{ __('lang.phone') }}</label>
        <p class="border form-control">{{$message->phone ?? '--'}}</p>
    </div>

    <div class="form-group col-12 col-md-12">
        <label class="form-label">{{ __('lang.message') }}</label>
        <p class="border form-control">{{$message->message ?? '--'}}</p>
    </div>
</div>
{{-- MODIFICATIONS TO HERE --}}


<div class="form-group float-right">
    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('lang.close') }}</button>
</div>