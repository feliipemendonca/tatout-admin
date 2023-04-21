<?php

namespace App\Http\Livewire;

use App\Repository\Interfaces\ProductRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;

    public $search, $cnpj;
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';

    public function render(ProductRepositoryInterface $repository)
    {
        $user = auth()->user();
        switch ($user->getRole()) {
            case 'company':
                $products = $repository->productsId($user->hasCompany->company);
                $items = $repository->all()->whereIn('id', $products)->latest();
                break;
            
            default:
                $items = $repository->all()->latest();
                break;
        }

        if($this->search) {
            $items->where(function($q) {
                $q->orWhere('name', 'like', '%'.$this->search.'%');
            });
        }

        return view('livewire.product',[
            'items' => $items->paginate(10)
        ]);
    }
}
