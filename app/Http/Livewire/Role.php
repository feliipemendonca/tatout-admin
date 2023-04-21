<?php

namespace App\Http\Livewire;

use App\Repository\Interfaces\RoleRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Role extends Component
{
    use WithPagination;
    public $search;
    protected $queryString = ['search'], $paginationTheme = 'bootstrap';

    public function render(RoleRepositoryInterface $repository)
    {
        $items = $repository->all()->latest();

        if($this->search) {
            $items->where(function($q) {
                $q->orWhere('name', 'like', '%'.$this->search.'%');
            });
        }

        return view('livewire.role',[
            'items' => $items->paginate(10)
        ]);
    }
}
