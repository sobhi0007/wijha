{{-- MODIFICATIONS FROM HERE --}}
<div class="row">
    <div class="form-group col-12 col-md-9">
        <label class="form-label">{{ __('lang.link') }}</label>
        <p class="border form-control">{{ $slider->link ?? '--' }}</p>
    </div>

    <div class="form-group col-12 col-md-3">
        <img src="{{ $slider->getFirstMediaUrl('image', 'thumb') }}" class="rounded mt-3" width="60%">
    </div>

    <div class="form-group col-12">
        <label class="form-label">{{ __('lang.text') }} {{ lang('en') }}</label>
        <p class="border form-control">{{ $slider->getTranslation('text', 'en') ?? '--' }}</p>
    </div>

    <div class="form-group col-12">
        <label class="form-label">{{ __('lang.text') }} {{ lang('ar') }}</label>
        <p class="border form-control">{{ $slider->getTranslation('text', 'ar') ?? '--' }}</p>
    </div>

</div>
{{-- MODIFICATIONS TO HERE --}}


<div class="form-group float-right">
    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('lang.close') }}</button>
</div>
