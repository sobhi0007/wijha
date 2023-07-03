<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class Login extends Component
{
    public $password;
    public $email;
 
    protected $rules = [
        'password' => 'required|min:8',
        'email' => 'required|email',
    ];
 
    public function submit()
    {   
        if (Auth::attempt($this->validate())) {
            request()->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            $this->addError('email', __('auth.failed'));
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
