{{-- Table --}}
<div class="table-responsive">
    <table class="table align-middle table-nowrap font-size-14">
        <thead class="bg-light">
            <tr>
                <th class="text-primary" width="5%">#</th>
                <th class="text-primary">{{ __('lang.booking') }}</th>
                <th class="text-primary">{{ __('lang.amount') }} {{ __('lang.currency') }}</th>
                <th class="text-primary">{{ __('lang.payment_method') }}</th>
                <th class="text-primary" width="11%">{{ __('lang.status') }}</th>
            </tr>
        </thead>

        <tbody>
            @if (count($data) > 0)
                @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->booking?->reference_number }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>{{ $item->payment_method }}</td>
                        <td>
                            <span class="badge {{ $item->status->color() }} text-white">
                                <i class="{{ $item->status->icon() }}"></i>
                                {{ $item->status->lang() }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            @else
                <x-empty-alert></x-empty-alert>
            @endif
        </tbody>
    </table>
</div>
