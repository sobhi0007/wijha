<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class Login extends Component
{
    public $password;
    public $emailOrPhone;

    public function rules()
    {
        return [
            'emailOrPhone' => filter_var($this->emailOrPhone, FILTER_VALIDATE_EMAIL)
                ? ['required', 'string', 'email']
                : ['required', 'min:11', 'max:20'],
            'password' => ['required', 'string'],
        ];
    }     
 
    public function submit()
    {   
        $this->validate();
        $emailOrPhone = filter_var($this->emailOrPhone,FILTER_VALIDATE_EMAIL)? 'email':'phone';
    
        if (Auth::guard()->attempt([$emailOrPhone => $this->emailOrPhone, 'password' => $this->password])) {
            request()->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            $this->addError('emailOrPhone', __('auth.failed'));
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
