<?php

namespace App\Http\Livewire;

use App\Models\ProductPrice as ModelsProductPrice;
use App\Models\TypePrice;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductPrice extends Component
{
    public $age, $amount, $status, $product;

    public function submit()
    {
        DB::beginTransaction();
        try {
            $this->product->prices()->create([
                'type_price_id' => $this->age,
                'amount' => $this->amount,
                'status' => $this->status,
            ])->save();
        } catch (\Throwable $th) {
            throw $th;
        }
        DB::commit();

        $this->age = "";
        $this->amount = "";
        $this->status = "";        

        return redirect()->route('dashboard.valores-passeios.show', $this->product->id)->with('sucess','Valor salvo com sucesso.');
    }

    public function render()
    {
        $items = ModelsProductPrice::latest();
        $prices = TypePrice::all();

        return view('livewire.product-price',[
            'items' => $items->paginate(15),
            'prices' => $prices
        ]);
    }
}
