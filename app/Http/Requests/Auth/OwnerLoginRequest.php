<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Enums\UserType;
use App\Enums\UserApproval;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class OwnerLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if( filter_var($this->request->get('emailOrPhone'),FILTER_VALIDATE_EMAIL)){
            return [
                'emailOrPhone' => ['required', 'string', 'email'],
                'password' => ['required', 'string'],
            ];
        }else{
            return [
                'emailOrPhone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
                'password' => ['required', 'string'],
            ];
        }
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(String $guard = 'web')
    {
        $this->ensureIsNotRateLimited();
        $emailOrPhone = filter_var($this->request->get('emailOrPhone'),FILTER_VALIDATE_EMAIL)? 'email':'phone';
        $user = User::where($emailOrPhone, $this->emailOrPhone)->first();
        if ($user?->type == UserType::OWNER && $user?->approval != UserApproval::APPROVED) {
            throw ValidationException::withMessages([
                'emailOrPhone' => trans('messages.owner_not_approved'),
            ]);
        }

     
        if (!Auth::guard($guard)->attempt([$emailOrPhone => $this->emailOrPhone, 'password' => $this->password, 'type' => UserType::OWNER->value, 'approval' => UserApproval::APPROVED->value], $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                $emailOrPhone => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('email')) . '|' . $this->ip();
    }
}
