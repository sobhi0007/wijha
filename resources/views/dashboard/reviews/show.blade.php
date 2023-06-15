{{-- MODIFICATIONS FROM HERE --}}
<div class="row">

    <div class="form-group col-12 col-md-3">
        <label class="form-label">{{ __('lang.booking') }}</label>
        <p class="border form-control">{{ $review->booking?->reference_number ?? '--' }}</p>
    </div>

    <div class="form-group col-12 col-md-3">
        <label class="form-label">{{ __('lang.unit') }}</label>
        <p class="border form-control">{{ $review->booking?->unit?->code ?? '--' }}</p>
    </div>

    <div class="form-group col-12 col-md-3">
        <label class="form-label">{{ __('lang.user') }}</label>
        <p class="border form-control">{{ $review->booking?->user?->name ?? '--' }}</p>
    </div>

    <div class="form-group col-12 col-md-3">
        <label class="form-label">{{ __('lang.accuracy') }}</label>
        <p class="border form-control">{{ $review->accuracy ?? '--' }}</p>
    </div>

    <div class="form-group col-12 col-md-3">
        <label class="form-label">{{ __('lang.cleanliness') }}</label>
        <p class="border form-control">{{ $review->cleanliness ?? '--' }}</p>
    </div>

    <div class="form-group col-12 col-md-3">
        <label class="form-label">{{ __('lang.services') }}</label>
        <p class="border form-control">{{ $review->services ?? '--' }}</p>
    </div>

    <div class="form-group col-12 col-md-3">
        <label class="form-label">{{ __('lang.location') }}</label>
        <p class="border form-control">{{ $review->location ?? '--' }}</p>
    </div>

    <div class="form-group col-12 col-md-3">
        <label class="form-label">{{ __('lang.overall_rating') }}</label>
        <p class="border form-control">{{ $review->overall_rating ?? '--' }}</p>
    </div>

    <div class="form-group col-12 col-md-12">
        <label class="form-label">{{ __('lang.name') }}</label>
        <p class="border form-control">{{ $review->review ?? '--' }}</p>
    </div>

</div>
{{-- MODIFICATIONS TO HERE --}}


<div class="form-group float-right">
    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('lang.close') }}</button>
</div>
