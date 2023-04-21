<?php

namespace App\Http\Livewire;

use App\Repository\Interfaces\TypeProductRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class TypeProduct extends Component
{
    use WithPagination;
    public $search;
    protected $queryString = ['search'], $paginationTheme = 'bootstrap';

    public function render(TypeProductRepositoryInterface $repository)
    {
        $items = $repository->all()->latest();

        if($this->search) {
            $items->where(function($q) {
                $q->orWhere('name', 'like', '%'.$this->search.'%');
            });
        }

        return view('livewire.type-product',[
            'items' => $items->paginate(10)
        ]);
    }
}
