{{-- MODIFICATIONS FROM HERE --}}
<div class="row">
    <div class="form-group col-12 col-md-6">
        <label class="form-label">{{ __('lang.name') }}</label>
        <p class="border form-control">{{ $user->name ?? '--' }}</p>
    </div>

    <div class="form-group col-12 col-md-6">
        <label class="form-label">{{ __('lang.email') }}</label>
        <p class="border form-control">{{ $user->email ?? '--' }}</p>
    </div>

    @if ($user->type == App\Enums\UserType::OWNER)
        <div class="form-group col-12 col-md-12">
            <label class="form-label">{{ __('lang.percentage') }}</label>
            <p class="border form-control">{{ $user->percentage . '%' ?? '--' }}</p>
        </div>
    @endif
</div>
{{-- MODIFICATIONS TO HERE --}}


<div class="form-group float-right">
    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('lang.close') }}</button>
</div>
