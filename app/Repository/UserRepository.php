<?php

namespace App\Repository;

use App\Models\CompanyUser;
use App\Models\Data;
use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface 
{
    private $model, $companyUser;

    public function __construct(User $model, CompanyUser $companyUser)
    {
        $this->model = $model;
        $this->companyUser = $companyUser;
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
        return $this->model;
    }

    public function sellersCompany($companyId)
    {
        $seller = [];
        $company = $this->companyUser->where('company_id', $companyId)->get();

        foreach ($company as $key => $item)
            if($item->user->getRole() == 'seller')
                $seller[$key] = $item->user->id;

        return $seller;
    }

    public function allSellers()
    {
        return $this->model;
    }

    public function store($request)
    {
        DB::beginTransaction();
        $model = new $this->model;
       
        if($this->model->withTrashed()->where("email", $request->email)->first())
            return redirect()->back()->withErrors(['email' => 'Já existe Registro de E-mail.']);


        try {
            $model->setData($model, $request->all());

            if($request->user_type)
                $model->assignRole($request->user_type);

            $model->save();
            $model->address()->create($request->all());
            $model->data()->create($request->except(['_token','_method','name']));

            if($request->supplier_id)
                $model->company()->attach([$request->supplier_id]);

        } catch (\Throwable $th) {
            // throw $th;
           return back()->with('error','Erro ao cadastrar Usuário. Por favor entre em contato com o suporte!');
        }

        DB::commit();

        return redirect()->route('dashboard.vendedores.index')->with('success','Usuário Cadastrado com sucesso!');
    }

    public function update($id, $request)
    {
        $model = self::find($id);
        $array = [$model->data->id];

        if($request->phone && in_array($request->phone, self::customQuery($array, 'phone')))
            return redirect()->back()->withErrors(['phone' => 'Já existe Registro de Celular.']);

        if($request->cpf && in_array($request->cpf, self::customQuery($array, 'cpf')))
            return redirect()->back()->withErrors(['cpf' => 'Já existe Registro de CPF.']);

        if($request->cnpj && in_array($request->cnpj, self::customQuery($array, 'cnpj')))
            return redirect()->back()->withErrors(['cnpj' => 'Já existe Registro de CNPJ.']);

        if($request->rg && in_array($request->rg, self::customQuery($array, 'rg')))
            return redirect()->back()->withErrors(['rg' => 'Já existe Registro de RG.']);


        DB::beginTransaction();
        try {
            $model->update($request->all());

            if($model->address == null)
                $model->address()->create($request->all());
            else
                $model->address()->update($request->except([
                    '_token','_method','name','cpf','email','password', 'rg','status_id','phone','fixo','status_id','createtur','supplier_id','user_type','commission'
                ]));
                

            if($model->data == null)
                $model->data()->create($request->except(['_token','_method','name']));
            else
                $model->data()->update($request->except([
                    '_token','_method','name','email', 'password','zip','state','city','district','address','number', 'complement','status_id','supplier_id','user_type'
                ]));

        } catch (\Throwable $th) {
            throw $th;
            return back()->with('error','Erro ao atualizar Usuário. Por favor entre em contato com o suporte!');
        }

        DB::commit();

        return redirect()->route('dashboard.vendedores.index')->with('success','Usuário atualizado com sucesso!');
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        try {
            $model->address?->delete();
            $model->data?->delete();
            $model->hasCompany?->delete();
            $model->delete();

        } catch (\Throwable $th) {
            //throw $th;

            return back()->with('error','Erro ao apagar Usuário. Por favor entre em contato com o suporte!');
        }

        return redirect()->route('dashboard.vendedores.index')->with('success','Usuário apagado com sucesso!');
    }

    private static function customQuery($id, $key) 
    {
        $query = Data::whereNotIn('id', $id)->select('id',$key)->get();
        $array = [];
        foreach($query as $item)
            $array[] = $item[$key];
        
        return $array;
    }
}