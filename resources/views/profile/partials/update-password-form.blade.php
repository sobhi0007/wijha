<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('lang.update_password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('lang.update_password_body') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" :value="__('lang.current_password')" />
            <x-text-input id="current_password" name="current_password" type="password" class="form-control rounded-lg my-2" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('lang.new_password')" />
            <x-text-input id="password" name="password" type="password" class="form-control rounded-lg my-2" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('lang.confirm_new_password')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="form-control rounded-lg my-2" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
          @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-success fw-bold"
                >{{ __('lang.profile_updated') }}</p>
            @endif
            <x-primary-button>{{ __('lang.update') }}</x-primary-button>

          
        </div>
    </form>
</section>
