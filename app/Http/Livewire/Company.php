<?php

namespace App\Http\Livewire;

use App\Repository\Interfaces\CompanyRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Company extends Component
{
    use WithPagination;
    public $search, $cnpj;
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';

    public function render(CompanyRepositoryInterface $repository)
    {
        $items = $repository->all()->latest();

        if($this->search) {
            $items->where(function($q) {
                $q->orWhere('name', 'like', '%'.$this->search.'%');
            });
        }

        if($this->cnpj) {
            $items->where(function($q) {
                $q->orWhere('name', 'like', '%'.$this->cnpj.'%');
            });
        }


        return view('livewire.company',[
            'items' => $items->paginate(10)
        ]);
    }
}
