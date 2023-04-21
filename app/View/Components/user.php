<?php

namespace App\View\Components;

use App\Models\Company;
use Illuminate\View\Component;

class user extends Component
{
    public $company = '',
    $name = '',
    $cpf = '',
    $rg = '',
    $email = '',
    $phone = '',
    $fixo = '',
    $commission = '';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($company, $name, $cpf, $rg, $email, $phone, $fixo, $commission)
    {
        $this->company = $company;
        $this->name = $name;
        $this->cpf = $cpf;
        $this->rg = $rg;
        $this->email = $email;
        $this->phone = $phone;
        $this->fixo = $fixo;
        $this->commission = $commission;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user');
    }
}
