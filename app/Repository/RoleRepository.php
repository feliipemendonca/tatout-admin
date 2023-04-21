<?php

namespace App\Repository;

use App\Models\RolesHasPermission;
use App\Repository\Interfaces\RoleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface 
{
    private $model;

    public function __construct(Role $model)
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
            return back()->with('error','Erro ao cadastrar tipo de produto. Por favor entre em contato com o suporte!');
        }
        DB::commit();

        return redirect()->route('dashboard.roles.index')->with('success','Tipo de produto Cadastrado com sucesso!');
    }

    public function update($request, $id)
    {
        $model = self::find($id);        
        DB::beginTransaction();
        try {

            $model->update($request->all());
            $this->createPermission($model, $request);

        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error','Erro ao atualizar nível de acesso. Por favor entre em contato com o suporte!');
        }
        DB::commit();

        return redirect()->route('dashboard.roles.index')->with('success','Nível de acesso atualizado com sucesso!');
    }

    public function delete($id)
    {
        $model = $this->find($id);

        try {

            for ($i=0; $i < $model->permissions->count(); $i++) { 
                RolesHasPermission::where("role_id", $model->id)->delete();
            }

            $model->delete();
            
        } catch (\Throwable $th) {
            throw $th;

            return back()->with('error','Erro ao apagar nível de acesso. Por favor entre em contato com o suporte!');
        }

        return redirect()->route('dashboard.roles.index')->with('success','Nível de acesso apagado com sucesso!');
    }

    private function createPermission($model, $request)
    {
        if($model->permissions) {
            for ($i=0; $i < $model->permissions->count(); $i++) { 
                RolesHasPermission::where("role_id", $model->id)->delete();
            }
        }

        if($request->permission) {
            return $model->givePermissionTo($request->permission);
        }
        
    }
}