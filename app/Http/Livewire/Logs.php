<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use OwenIt\Auditing\Models\Audit;

class Logs extends Component
{
    use WithPagination;

    public $search;
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $items = Audit::latest();

        return view('livewire.logs',[
            'items' => $items->paginate(10)
        ]);
    }
}
