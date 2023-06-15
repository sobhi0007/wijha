<form action="{{ route('admin.faqs.store') }}" method="post" id="add_form" enctype="multipart/form-data">
    @csrf

    <div id="add_form_messages"></div>

    {{-- MODIFICATIONS FROM HERE --}}
    <div class="row">
        <div class="form-group col-12">
            <label class="form-label">{{ __('lang.faq') }} {{ lang('en') }}</label>
            <input type="text" class="border form-control" name="question_en"
                placeholder="{{ __('lang.please_enter') }} {{ __('lang.faq') }}...">
        </div>

        <div class="form-group col-12">
            <label class="form-label">{{ __('lang.faq') }} {{ lang('ar') }}</label>
            <input type="email" class="border form-control" name="question_ar"
                placeholder="{{ __('lang.please_enter') }} {{ __('lang.faq') }}...">
        </div>

        <div class="form-group col-12">
            <label class="form-label">{{ __('lang.answer') }} {{ lang('en') }}</label>
            <textarea class="border form-control" name="answer_en"
                placeholder="{{ __('lang.please_enter') }} {{ __('lang.answer') }}..."></textarea>
        </div>

        <div class="form-group col-12">
            <label class="form-label">{{ __('lang.answer') }} {{ lang('ar') }}</label>
            <textarea class="border form-control" name="answer_ar"
                placeholder="{{ __('lang.please_enter') }} {{ __('lang.answer') }}..."></textarea>
        </div>
    </div>
    {{-- MODIFICATIONS TO HERE --}}

    <div class="form-group float-right mt-2">
        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('lang.close') }}</button>
        <button type="button" class="btn btn-primary" id="submit_add_form">
            {{ __('lang.submit') }}
            @include('dashboard.modals.spinner')
        </button>
    </div>
</form>
