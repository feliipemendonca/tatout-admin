<?php

namespace App\Repository;

use App\Models\ProductPrice;
use App\Repository\Interfaces\ProductPriceRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductPriceRepository implements ProductPriceRepositoryInterface 
{
    private $model;

    public function __construct(ProductPrice $model)
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

     public function suppliers()
    {
        return $this->model->role('supplier');
    }

    public function store($request)
    {
        DB::beginTransaction();
        $model = new $this->model;

        try {
            

        } catch (\Throwable $th) {
            throw $th;
           return back()->with('error','Erro ao cadastrar Usuário. Por favor entre em contato com o suporte!');
        }

        DB::commit();

        return redirect()->route('dashboard.vendedores.index')->with('success','Usuário Cadastrado com sucesso!');
    }

    public function update($id, $request)
    {
        $model = self::find($id);

        DB::beginTransaction();
        try {
            $model->update($request->all());

            if($model->address == null)
                $model->address()->create($request->all());
            else
                $model->address()->update($request->except([
                    '_token','_method','name','cpf','email','password', 'rg','status_id','phone','fixo','status_id','createtur'
                ]));
                

            if($model->data == null)
                $model->data()->create($request->except(['_token','_method','name']));
            else
                $model->data()->update($request->except([
                    '_token','_method','name','email', 'password','zip','state','city','district','address','number', 'complement','status_id'
                ]));

        } catch (\Throwable $th) {
            // throw $th;
            return back()->with('error','Erro ao atualizar Usuário. Por favor entre em contato com o suporte!');
        }

        DB::commit();

        return redirect()->route('dashboard.vendedores.index')->with('success','Usuário atualizado com sucesso!');
    }

    public function delete($id)
    {
        try {
            self::find($id)->delete();
        } catch (\Throwable $th) {
            //throw $th;

            return back()->with('error','Erro ao apagar Usuário. Por favor entre em contato com o suporte!');
        }

        return redirect()->route('dashboard.vendedores.index')->with('success','Usuário apagado com sucesso!');
    }
}