<?php

namespace App\Http\Livewire;

use App\Repository\Interfaces\PermissionRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Permission extends Component
{
    use WithPagination;
    public $search;
    protected $queryString = ['search'], $paginationTheme = 'bootstrap';

    public function render(PermissionRepositoryInterface $repository)
    {
        $items = $repository->all()->latest();

        if($this->search) {
            $items->where(function($q) {
                $q->orWhere('name', 'like', '%'.$this->search.'%');
            });
        }

        return view('livewire.permission',[
            'items' => $items->paginate(25)
        ]);
    }
}
