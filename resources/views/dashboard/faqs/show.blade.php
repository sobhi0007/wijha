{{-- MODIFICATIONS FROM HERE --}}
<div class="row">

    <div class="form-group col-12">
        <label class="form-label">{{ __('lang.faq') }} {{ lang('en') }}</label>
        <p class="border form-control">{{ $faq->question_en ?? '--' }}</p>
    </div>

    <div class="form-group col-12">
        <label class="form-label">{{ __('lang.faq') }} {{ lang('ar') }}</label>
        <p class="border form-control">{{ $faq->question_ar ?? '--' }}</p>
    </div>

    <div class="form-group col-12">
        <label class="form-label">{{ __('lang.answer') }} {{ lang('en') }}</label>
        <p class="border form-control">{{ $faq->answer_en ?? '--' }}</p>
    </div>

    <div class="form-group col-12">
        <label class="form-label">{{ __('lang.answer') }} {{ lang('ar') }}</label>
        <p class="border form-control">{{ $faq->answer_ar ?? '--' }}</p>
    </div>

</div>
{{-- MODIFICATIONS TO HERE --}}


<div class="form-group float-right">
    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('lang.close') }}</button>
</div>
