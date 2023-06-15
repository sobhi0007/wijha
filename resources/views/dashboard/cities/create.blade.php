<form action="{{ route('admin.cities.store') }}" method="post" id="add_form" enctype="multipart/form-data">
    @csrf

    <div id="add_form_messages"></div>

    {{-- MODIFICATIONS FROM HERE --}}
    <div class="row">
        <div class="form-group col-12 col-md-6">
            <label class="form-label">{{ __('lang.name') }} {{ lang('en') }}</label>
            <input type="text" class="border form-control" name="name_en"
                placeholder="{{ __('lang.please_enter') }} {{ __('lang.name') }}...">
        </div>

        <div class="form-group col-12 col-md-6">
            <label class="form-label">{{ __('lang.name') }} {{ lang('ar') }}</label>
            <input type="text" class="border form-control" name="name_ar"
                placeholder="{{ __('lang.please_enter') }} {{ __('lang.name') }}...">
        </div>

        <div class="form-group col-12">
            <label class="form-label">{{ __('lang.image') }}</label>
            <div class="custom-file d-block" name="image">
                <label class="custom-file-label">{{ __('lang.image') }}</label>
                <input type="file" class="custom-file-input" id="customFile" name="image"
                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.image') }}...">
            </div>
        </div>


        <div class="form-group col-12 ml-4">
            <div class="mt-4">
                <input class="form-check-input" type="checkbox" name="featured" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Show this city in sliders at Homepage
                </label>
            </div>  
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
