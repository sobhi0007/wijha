<?php

namespace App\Http\Livewire;
use App\Models\City;
use Livewire\Component;

class Search extends Component
{
    public $search;
    public $cities=[];
    
    public function render()
    {
     $this->cities=   City::search($this->search)->get();
        
        return view('livewire.search')->with('cities', $this->cities);
    }
}
