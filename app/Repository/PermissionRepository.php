<?php

namespace App\Repository;

use App\Repository\Interfaces\PermissionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface 
{
    private $model;

    public function __construct(Permission $model)
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
        $model = new $this->model;
        try {
            $model->create($request->all());           

        } catch (\Throwable $th) {
            throw $th;
            return back()->with('error','Erro ao cadastrar permissão. Por favor entre em contato com o suporte!');
        }
        DB::commit();

        return redirect()->route('dashboard.permission.index')->with('success','Permissão Cadastrado com sucesso!');
    }

    public function update($request, $id)
    {
        $model = self::find($id);
        DB::beginTransaction();
        try {
            $model->update($request->all());

        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error','Erro ao atualizar permissão. Por favor entre em contato com o suporte!');
        }
        DB::commit();

        return redirect()->route('dashboard.permission.index')->with('success','Permissão atualizado com sucesso!');
    }

    public function delete($id)
    {
        try {
            self::find($id)->delete();
        } catch (\Throwable $th) {
            throw $th;

            return back()->with('error','Erro ao apagar permissão. Por favor entre em contato com o suporte!');
        }

        return redirect()->route('dashboard.permission.index')->with('success','Permissão apagado com sucesso!');
    }
}