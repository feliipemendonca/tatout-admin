<?php

namespace App\View\Components;

use Illuminate\View\Component;

class address extends Component
{
    public $zip = '', $address = '', $state = '', $city = '', $district = '', $number = '', $complement = '';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($zip, $address, $state, $city, $district, $number, $complement)
    {
        $this->zip = $zip;
        $this->address = $address;
        $this->state = $state;
        $this->city = $city;
        $this->district = $district;
        $this->number = $number;
        $this->complement = $complement;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.address');
    }
}
