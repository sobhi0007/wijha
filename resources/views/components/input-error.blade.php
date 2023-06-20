@props(['messages'])

@if ($messages)
    {{-- <ul {{ $attributes->merge(['class' => 'text-sm text-danger list-group']) }}> --}}
        @foreach ((array) $messages as $message)
            <span class="text-danger fw-bold" >{{ $message }}</span>
        @endforeach
    {{-- </ul> --}}
@endif
