<div class="table-responsive">
    <table class="table align-middle table-nowrap font-size-14">
        <thead class="bg-light">
            <tr>
                <th class="text-primary" width="5%">#</th>
                <th class="text-primary" width="11%">{{ __('lang.code') }}</th>
                <th class="text-primary">{{ __('lang.title') }}</th>
                <th class="text-primary">{{ __('lang.user') }}</th>
                <th class="text-primary" width="11%">{{ __('lang.status') }}</th>
                <th class="text-primary" width="11%">{{ __('lang.activation') }}</th>
            </tr>
        </thead>

        <tbody>
            @if (count($data) > 0)
                @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="text-danger">{{ $item->code }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->user?->name }}</td>
                        <td>
                            <span class="badge {{ $item->status->color() }} text-white">
                                <i class="{{ $item->status->icon() }}"></i>
                                {{ $item->status->lang() }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $item->activation->color() }} text-white">
                                <i class="{{ $item->activation->icon() }}"></i>
                                {{ $item->activation->lang() }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
