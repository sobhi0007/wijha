{{-- MODIFICATIONS FROM HERE --}}
<div class="row">

    <div class="form-group col-12 col-md-4">
        <label class="form-label">{{ __('lang.booking') }}</label>
        <p class="border form-control">{{ $payment->booking?->reference_number ?? '--' }}</p>
    </div>

    <div class="form-group col-12 col-md-4">
        <label class="form-label">{{ __('lang.unit') }}</label>
        <p class="border form-control">{{ $payment->booking?->unit?->code ?? '--' }}</p>
    </div>

    <div class="form-group col-12 col-md-4">
        <label class="form-label">{{ __('lang.user') }}</label>
        <p class="border form-control">{{ $payment->booking?->user?->name ?? '--' }}</p>
    </div>

    <div class="form-group col-12 col-md-4">
        <label class="form-label">{{ __('lang.amount') }} {{ lang('currency') }}</label>
        <p class="border form-control">{{ $payment->amount ?? '--' }}</p>
    </div>

    <div class="form-group col-12 col-md-4">
        <label class="form-label">{{ __('lang.payment_method') }}</label>
        <p class="border form-control">{{ $payment->payment_method ?? '--' }}</p>
    </div>

    <div class="form-group col-12 col-md-4">
        <label class="form-label">{{ __('lang.status') }}</label><br>
        <span class="badge {{ $payment->status->color() }} text-white mt-2">
            <i class="{{ $payment->status->icon() }}"></i>
            {{ $payment->status->lang() }}
        </span>
    </div>

</div>
{{-- MODIFICATIONS TO HERE --}}


<div class="form-group float-right">
    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('lang.close') }}</button>
</div>
