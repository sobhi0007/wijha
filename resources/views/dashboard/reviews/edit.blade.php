<form action="{{ route('admin.reviews.update', ['review' => $review]) }}" method="post" id="edit_form"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div id="edit_form_messages"></div>

    {{-- MODIFICATIONS FROM HERE --}}
    <div class="row">
        <div class="col-12">
            <label class="form-label">{{ __('lang.status') }}</label>
            <div name="status">
                <select class="form-control" name="status">
                    <option value="" selected>{{ __('lang.select_status') }}</option>
                    @foreach (App\Enums\ReviewStatus::cases() as $item)
                        <option value="{{ $item->value }}" @selected($review->status == $item)>
                            {{ $item->lang() }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    {{-- MODIFICATIONS TO HERE --}}

    <div class="form-group float-right mt-2">
        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('lang.close') }}</button>
        <button type="button" class="btn btn-primary" id="submit_edit_form">
            {{ __('lang.submit') }}
            @include('dashboard.modals.spinner')
        </button>
    </div>
</form>
