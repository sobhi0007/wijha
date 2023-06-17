<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Wishlist;

class WishlistUnits extends Component
{
    public $color;
    public $unit_id;
    
    public function render()
    {
        return view('livewire.wishlist');
    }
    
    public function addToWishlist() {
        $whishlsit = Wishlist::where('unit_id',$this->unit_id)->where('user_id',auth()->user()->id)->first();
       if($whishlsit ){
        $whishlsit->delete();
        $this->color='text-light  fa-beat-fade';

       }else{
      Wishlist::create([
            'user_id'=>auth()->user()->id,
            'unit_id'=>$this->unit_id
        ]);
        $this->color='text-danger';
       }
      
    }

    public function mount($unit_id ,$color)
    {
        $this->unit_id = $unit_id;
        $this->color = $color;

    }

}
