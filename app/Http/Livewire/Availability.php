<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Availability extends Component
{
    public $product;

    public function render()
    {
        $items = $this->product->availabilitys()->paginate(15);

        return view('livewire.availability',[
            'items' => $items
        ]);
    }
}
