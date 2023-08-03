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
 
    protected $rules =  ( filter_var($this->request->get('emailOrPhone'),FILTER_VALIDATE_EMAIL))?
         [
            'emailOrPhone' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]
        :
         [
            'emailOrPhone' => ['required', 'min:11', 'max:20'],
            'password' => ['required', 'string'],
        ];
    

        
 
    public function submit()
    {   
        $emailOrPhone = filter_var($this->request->get('emailOrPhone'),FILTER_VALIDATE_EMAIL)? 'email':'phone';
     dd($emailOrPhone);
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
