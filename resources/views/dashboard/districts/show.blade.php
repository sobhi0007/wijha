{{-- MODIFICATIONS FROM HERE --}}
<div class="row">

    <div class="form-group col-12 col-md-5">
        <label class="form-label">{{ __('lang.name') }} {{ lang('en') }}</label>
        <p class="border form-control">{{ $city->name_en ?? '--' }}</p>
    </div>

    <div class="form-group col-12 col-md-5">
        <label class="form-label">{{ __('lang.name') }} {{ lang('ar') }}</label>
        <p class="border form-control">{{ $city->name_ar ?? '--' }}</p>
    </div>

    <div class="form-group col-12 col-md-2">
        <img src="{{ $city->getFirstMediaUrl('image', 'thumb') }}" class="rounded mt-4" width="60%">
    </div>

</div>
{{-- MODIFICATIONS TO HERE --}}


<div class="form-group float-right">
    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('lang.close') }}</button>
</div>
