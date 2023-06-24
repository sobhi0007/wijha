<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Gallary extends Component
{
    public $unit;
    public $deleted=[];
    
    public function delete($img)
    {
        $media = Media::findOrFail($img);
        $media->delete();
        $this->deleted[]=$img;
    }

    public function render()
    {
        return view('livewire.gallary');
    }
}
