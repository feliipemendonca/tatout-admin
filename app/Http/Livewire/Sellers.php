<?php

namespace App\Http\Livewire;

use App\Repository\Interfaces\UserRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Sellers extends Component
{
    use WithPagination;
    public $search;
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';

    public function render(UserRepositoryInterface $repository)
    {
        $user = auth()->user();

        // dd($repository->allSellers()->role("seller")->get());
        switch ($user->getRole()) {
            case 'company':
                $sellers = $repository->sellersCompany($user->hasCompany->company_id);
                $items = $repository->all()->whereIn('id', $sellers)->latest();
                break;
            
            default:
                $items = $repository->allSellers()->role("seller");
                break;
        }

        if($this->search) {
            $items = $items->where(function($q) {
                $q->orWhere('name', 'like', '%'.$this->search.'%');
            });
        }

        return view('livewire.sellers',[
            'items' => $items->paginate(10)
        ]);
    }
}
