<form action="{{ route('admin.users.update', ['user' => $user]) }}" method="post" id="edit_form"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div id="edit_form_messages"></div>

    {{-- MODIFICATIONS FROM HERE --}}
    <div class="row">
        @if ($user->type == App\Enums\UserType::OWNER)
            <div class="form-group col-12 col-md-12">
                <label class="form-label">{{ __('lang.approval') }}</label>
                <div name="approval">
                    <select class="form-control select2 bg-light" name="approval">
                        <option value="" selected>{{ __('lang.select_status') }}</option>
                        @foreach (App\Enums\UserApproval::cases() as $item)
                            <option value="{{ $item->value }}" @selected($user->approval == $item)>
                                {{ $item->lang() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif

        <div class="form-group col-12 col-md-4">
            <label class="form-label">{{ __('lang.name') }}</label>
            <input type="text" class="border form-control" name="name"
                placeholder="{{ __('lang.please_enter') }} {{ __('lang.name') }}..." value="{{ $user->name }}">
        </div>

        <div class="form-group col-12 col-md-4">
            <label class="form-label">{{ __('lang.email') }}</label>
            <input type="email" class="border form-control" name="email"
                placeholder="{{ __('lang.please_enter') }} {{ __('lang.email') }}..." value="{{ $user->email }}">
        </div>


           <div class="form-group col-12 col-md-4">
            <label class="form-label">{{ __('lang.phone') }}</label>
            <input type="phone" class="border form-control" name="phone"
                placeholder="{{ __('lang.please_enter') }} {{ __('lang.phone') }}..." value="{{ $user->phone }}">
        </div>


        <div class="form-group col-12 col-md-4">
            <label class="form-label">{{ __('lang.password') }}</label>
            <input type="password" class="border form-control" name="password"
                placeholder="{{ __('lang.please_enter') }} {{ __('lang.password') }}...">
        </div>

        <div class="form-group col-12 col-md-4">
            <label class="form-label">{{ __('lang.password_confirmation') }}</label>
            <input type="password" class="border form-control" name="password_confirmation"
                placeholder="{{ __('lang.please_enter') }} {{ __('lang.password_confirmation') }}...">
        </div>

        <div class="form-group col-12 col-md-4">
            <label class="form-label">{{ __('lang.approval') }}</label>
            <div name="approval">
                <select class="form-control select2" name="approval">
                    <option value="" selected>{{__("lang.approval")}}</option>
                    @foreach (App\Enums\UserApproval::cases() as $item)
                        <option value="{{ $item->value }}" @selected($user->approval == $item)>
                            {{ $item->lang() }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @if ($user->type == App\Enums\UserType::OWNER)
            <div class="form-group col-12 col-md-12">
                <label class="form-label">{{ __('lang.percentage') }} %</label>
                <input type="number" step="0.01" min="1" class="border form-control" name="percentage"
                    placeholder="{{ __('lang.please_enter') }} {{ __('lang.percentage') }}..."
                    value="{{ $user->percentage }}">
            </div>
        @endif
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
