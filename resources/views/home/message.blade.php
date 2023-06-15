@extends('layouts.home')


@section('content')

<div class=" container my-5">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
  <h3>{{__('lang.contact_us')}}</h3>
  <hr class="title-hr">

  <form action="{{ route('message.store') }}" method="POST">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-12">
            <div class="my-2">
                <div class="form-floating">
                    <input type="text" class="form-control rounded-lg @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="{{ __('lang.name') }}" value="{{ old('name') }}">
                    <label for="name" class="form-label text-muted fw-bold">{{ __('lang.name') }}</label>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="my-2">
                <div class="form-floating">
                    <input type="email" class="form-control rounded-lg @error('email') is-invalid @enderror"
                        name="email" id="email" placeholder="{{ __('lang.email') }}" value="{{ old('email') }}">
                    <label for="email" class="form-label text-muted fw-bold">{{ __('lang.email') }}</label>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="my-2">
                <div class="form-floating">
                    <input type="text" class="form-control rounded-lg @error('phone') is-invalid @enderror"
                        id="phone" name="phone" placeholder="{{ __('lang.phone') }}" value="{{ old('phone') }}">
                    <label for="phone" class="form-label text-muted fw-bold">{{ __('lang.phone') }}</label>
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="my-2">
                <label for="message"
                    class="form-label text-secondary fw-bold">{{ __('lang.message') }}</label>
                <textarea name="message" class="form-control rounded-lg @error('message') is-invalid @enderror"
                    id="message" rows="3">{{ old('message') }}</textarea>
                @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-end">
                <button type="submit"
                    class="btn bg-main text-light rounded-lg py-2 px-3">{{ __('lang.send') }}</button>
            </div>
        </div>
    </div>
</form>
</div>
@endsection