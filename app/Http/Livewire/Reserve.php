<?php

namespace App\Http\Livewire;

use App\Repository\Interfaces\CompanyRepositoryInterface;
use App\Repository\Interfaces\ReserveRepositoryInterface;
use App\Repository\Interfaces\UserRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Reserve extends Component
{
    use WithPagination;

    public $search, $cnpj, $companySearch, $userSearch;
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';

    public function render(ReserveRepositoryInterface $repository, CompanyRepositoryInterface $companyRepository, UserRepositoryInterface $userRepository)
    {
        $items = $repository->all()->latest();

        if($this->companySearch) {
            $items->where(function($q) {
                $q->orWhere('company_id', $this->companySearch);
            });
        }

         if($this->userSearch) {
            $items->where(function($q) {
                $q->orWhere('user_id', $this->userSearch);
            });
        }

        if($this->search) {
            $items->where(function($q) {
                $q->orWhere('name', 'like', '%'.$this->search.'%');
            });
        }

        return view('livewire.reserve', [
            'items' => $items->paginate(20),
            'company' => $companyRepository->all()->orderBy('name','asc')->get(),
            'user' => $userRepository->all()->orderBy('name','asc')->role('seller')->get()
        ]);
    }
}
