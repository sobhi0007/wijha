@php
    $modelName = App\Models\Payment::class;
@endphp

<x-filteration :modelName="$modelName">

    <div class="row">

        <div class="col-md-4">
            <label class="label-filter">{{ __('lang.word') }}</label>
            <input type="text" name="word" class="form-control"
                placeholder="{{ __('lang.please_enter') }} {{ __('lang.word') }}" value="{{ request()->input('word') }}">
        </div>

        <div class="col-md-4">
            <label class="label-filter">{{ __('lang.status') }}</label>
            <select class="form-control select2" name="status" style="width: 100%">
                <option value="" selected>{{ __('lang.select_status') }}</option>
                @foreach (App\Enums\PaymentStatus::cases() as $item)
                    <option value="{{ $item->value }}" @if (isset($data['status']) && $data['status'] == $item->value) selected @endif>
                        {{ $item->lang() }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label class="label-filter">{{ __('lang.date') }}</label>
            <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd"
                data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                <input type="date" class="form-control" name="start" placeholder="{{ __('lang.date_from') }}"
                    value="{{ request()->input('start') }}" />
                <input type="date" class="form-control" name="end" placeholder="{{ __('lang.date_to') }}"
                    value="{{ request()->input('end') }}" />
            </div>
        </div>

    </div>

</x-filteration>
