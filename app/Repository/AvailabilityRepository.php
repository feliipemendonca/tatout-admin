<?php

namespace App\Repository;

use App\Models\Availability;
use App\Models\Product;
use App\Repository\Interfaces\AvailabilityRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AvailabilityRepository implements AvailabilityRepositoryInterface 
{
    private $model, $product;

    public function __construct(Availability $model, Product $product)
    {
        $this->model = $model;
        $this->product = $product;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function all() 
    {
        return $this->model;
    }

     public function suppliers()
    {
        return $this->model->role('supplier');
    }

    public function store($request, $id)
    {
        $product = $this->product->find($id);
        DB::beginTransaction();
        try {
            $dates = explode(", ", $request->date);
            $newRequest = [];

            foreach($dates as $item) {
                $newRequest[] = [
                    'date' => Carbon::createFromFormat('d/m/Y', $item)->format('Y-m-d'),
                    'time' => convertInTimeInt($request->time),
                    'quantity' => $request->quantity,
                    'type_price_id' => $request->type_price_id,
                    'amount' => $request->amount,
                    'status_id' => $request->status_id
                ];               
            }

            foreach($newRequest as $item) {
                try {
                    $product->availabilitys()->create($item);
                } catch (\Throwable $th) {
                    throw $th;
                }
            }

        } catch (\Throwable $th) {
            throw $th;
            return back()->with('error','Erro ao cadastrar Agenda. Por favor entre em contato com o suporte!');
        }

        DB::commit();

        return redirect()->route('dashboard.passeios.agenda.index',['passeio' => $product->id])->with('success','Agenda cadastrado com sucesso!');
    }

    public function update($request, $id)
    {
        $model = $this->find($id);
        DB::beginTransaction();
        try {
            $model->setData($model, $request->all());
            $model->save();

        } catch (\Throwable $th) {
            throw $th;
            return back()->with('error','Erro ao atualizar Agenda. Por favor entre em contato com o suporte!');
        }

        DB::commit();

        return redirect()->route('dashboard.passeios.agenda.index',['passeio' => $model->availabisable->id])->with('success','Agenda atualizado com sucesso!');
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        DB::beginTransaction();
        try {
            $model->delete();
        } catch (\Throwable $th) {
            throw $th;

            return back()->with('error','Erro ao apagar Usuário. Por favor entre em contato com o suporte!');
        }
        DB::commit();

        return redirect()->back()->with('success','Agenda apagado com sucesso!');
    }
}