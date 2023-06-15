<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Payment extends Component
{
    public $checkin;
    public $checkout;
    public $new ; 


    public function checkoutChange(){
     $this->new = $this->checkout;
    }

    public function render()
    {
        return view('livewire.payment');
    }
}