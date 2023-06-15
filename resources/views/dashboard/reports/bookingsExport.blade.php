{{-- Table --}}
<div class="table-responsive">
    <table class="table align-middle table-nowrap font-size-14">
        <thead class="bg-light">
            <tr>
                <th class="text-primary" width="5%">#</th>
                <th class="text-primary" width="20%">{{ __('lang.reference_number') }}</th>
                <th class="text-primary">{{ __('lang.unit') }}</th>
                <th class="text-primary">{{ __('lang.user') }}</th>
                <th class="text-primary" width="11%">{{ __('lang.status') }}</th>
            </tr>
        </thead>

        <tbody>
            @if (count($data) > 0)
                @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="text-danger">{{ $item->reference_number }}</td>
                        <td>{{ $item->unit?->code }}</td>
                        <td>{{ $item->user?->name }}</td>
                        <td>
                            <span class="badge {{ $item->status->color() }} text-white">
                                <i class="{{ $item->status->icon() }}"></i>
                                {{ $item->status->lang() }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
