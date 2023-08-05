<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Enums\UserType;
use Livewire\Component;
use App\Enums\UserApproval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class Register extends Component
{

    
    public $email;
    public $phone;
    public $name;
    public $password;
    public $password_confirmation;
 
    public function rules()
    {
        return  [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => ['required',  'min:11' ,'max:20', 'unique:' . User::class],
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function submit(){
        $this->validate();

        $user = User::create([
            'name' => trim($this->name),
            'email' => trim($this->email),
            'phone' => $this->phone,
            'password' => trim($this->password),
            'type' => UserType::USER,
            'approval' => UserApproval::PENDING,
        ]);

        event(new Registered($user));
        
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    } 


    public function render()
    {
        return view('livewire.register');
    }
}
