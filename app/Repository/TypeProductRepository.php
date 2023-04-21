<?php

namespace App\Repository;

use App\Models\TypeProduct;
use App\Repository\Interfaces\TypeProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TypeProductRepository implements TypeProductRepositoryInterface 
{
    private $model;

    public function __construct(TypeProduct $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function all() 
    {
        return $this->model;
    }

    public function store($request)
    {
        DB::beginTransaction();
        
        try {
            $this->model->create($request->all());           

        } catch (\Throwable $th) {
            throw $th;
            return back()->with('error','Erro ao cadastrar tipo de produto. Por favor entre em contato com o suporte!');
        }
        DB::commit();

        return redirect()->route('dashboard.tipo-produto.index')->with('success','Tipo de produto Cadastrado com sucesso!');
    }

    public function update($id, $request)
    {
        $model = self::find($id);
        DB::beginTransaction();

        try {
            $model->update($request->all());

        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error','Erro ao atualizar tipo de produto. Por favor entre em contato com o suporte!');
        }
        DB::commit();

        return redirect()->route('dashboard.tipo-produto.index')->with('success','Tipo de produto atualizado com sucesso!');
    }

    public function delete($id)
    {
        try {
            self::find($id)->delete();
        } catch (\Throwable $th) {
            throw $th;

            return back()->with('error','Erro ao apagar tipo de produto. Por favor entre em contato com o suporte!');
        }

        return redirect()->route('dashboard.tipo-produto.index')->with('success','Tipo de produto apagado com sucesso!');
    }
}