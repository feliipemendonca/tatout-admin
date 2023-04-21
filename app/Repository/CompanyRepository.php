<?php

namespace App\Repository;

use App\Models\Company;
use App\Models\Data;
use App\Models\User;
use App\Repository\Interfaces\CompanyRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanyRepository implements CompanyRepositoryInterface 
{
    private $model;

    public function __construct(Company $model)
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
            self::customRequestUser($request);

            $user = new User;
            $user->setData($user, $request->all());
            $user->assignRole('company');
            $user->save();
            $user->data()->create($request->all()); 

            self::customRequestCompany($request, $user);

            $model = $this->model->create($request->all());
            $model->address()->create($request->all());            
            $model->data()->create($request->all()); 

            $user->company()->attach([$model->id]);
        

        } catch (\Throwable $th) {
            throw $th;
            return back()->with('error','Erro ao cadastrar fornecedor. Por favor entre em contato com o suporte!');
        }
        DB::commit();

        return redirect()->route('dashboard.fornecedores.index')->with('success','Fornecedor Cadastrado com sucesso!');
    }

    public function update($id, $request)
    {
        $model = self::find($id);
        $array = [
            $model->data->id, 
            $model->getUser->data->id
        ];

        if($request->email == null) {
            return redirect()->back()->withErrors(['email' => 'O campo E-mail é obrigatório.']);
        }

        if($request->cpf == null) {
            return redirect()->back()->withErrors(['cpf' => 'O campo CPF é obrigatório.']);
        }

        if($request->rg == null) {
            return redirect()->back()->withErrors(['rg' => 'O campo RG é obrigatório.']);
        }

        if($request->phone == null) {
            return redirect()->back()->withErrors(['phone' => 'O campo Celular do usuário é obrigatório.']);
        }

        if($request->company_phone == null) {
            return redirect()->back()->withErrors(['company_phone' => 'O campo Celular é obrigatório.']);
        }

        if($request->company_phone && in_array($request->company_phone, self::customQuery($array, 'company_phone')))
            return redirect()->back()->withErrors(['company_phone' => 'Já existe Registro de Celular.']);

        if($request->company_fixo && in_array($request->company_fixo, self::customQuery($array, 'company_fixo')))
            return redirect()->back()->withErrors(['company_fixo' => 'Já existe Registro de Fixo.']);

        if($request->phone && in_array($request->phone, self::customQuery($array, 'phone')))
            return redirect()->back()->withErrors(['phone' => 'Já existe Registro de Celular.']);

        if($request->cpf && in_array($request->cpf, self::customQuery($array, 'cpf')))
            return redirect()->back()->withErrors(['cpf' => 'Já existe Registro de CPF.']);

        if($request->cnpj && in_array($request->cnpj, self::customQuery($array, 'cnpj')))
            return redirect()->back()->withErrors(['cnpj' => 'Já existe Registro de CNPJ.']);

        if($request->rg && in_array($request->rg, self::customQuery($array, 'rg')))
            return redirect()->back()->withErrors(['rg' => 'Já existe Registro de RG.']);

        if($request->createtur && in_array($request->createtur, self::customQuery($array, 'createtur')))
            return redirect()->back()->withErrors(['createtur' => 'Já existe Registro de CadastraTur.']);
        
        DB::beginTransaction();

        try {
            
            self::customRequestUser($request);

            $user = $model->getUser;
            $user->setData($user, $request->all());
            $user->save();

            $data = $user->data;
            $data->setData($data, $request->all());
            $data->save();

            $address = $model->address;
            $address->setData($address, $request->all());
            $address->save();

            self::customRequestCompany($request, $user);            

            $data = $model->data;
            $data->update($request->all());
            $data->save();

            $request['name'] = $request->company;
            $model->update($request->all());

        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error','Erro ao atualizar fornecedor. Por favor entre em contato com o suporte!');
        }
        DB::commit();

        return redirect()->route('dashboard.fornecedores.index')->with('success','Fornecedor atualizado com sucesso!');
    }

    public function delete($id)
    {
        $model = self::find($id);
        DB::beginTransaction();
        try {
            if($model->users->count() > 0) {
                foreach($model->users as $item) {
                    $item->address?->delete();
                    $item->data?->delete();
                    $item->delete();
                }
            }

            if($model->products->count() > 0) {
                foreach($model->products as $item) {
                    foreach($item->file as $file) {
                        Storage::delete($file->name);
                        $file->delete();
                    }

                    foreach ($item->prices as $price) {
                        $price->delete();
                    }

                    foreach ($item->availabilitys as $av) {
                        $av->delete();
                    }

                    $item->delete();                    
                }
            }

            $model?->getUser?->address?->delete();
            $model?->getUser?->data?->delete();
            $model?->getUser?->delete();
            $model?->address?->delete();
            $model?->data?->delete();
            $model->delete();

        } catch (\Throwable $th) {
            throw $th;
            return back()->with('error','Erro ao apagar Fornecedor. Por favor entre em contato com o suporte!');
        }
        DB::commit();

        return redirect()->route('dashboard.fornecedores.index')->with('success','Fornecedor apagado com sucesso!');
    }

    private static function customQuery($id, $key) 
    {
        $query = Data::whereNotIn('id', $id)->select('id',$key)->get();
        $array = [];
        foreach($query as $item)
            $array[] = $item[$key];
        
        return $array;
    }

    private static function customRequestUser($request)
    {
        $request['cnpjcompany'] = $request->cnpj;
        $request['companyecreatetur'] = $request->createtur;
        $request['companyphone'] = $request->company_phone;
        $request['companyfixo'] = $request->company_fixo;
        $request['company_phone'] = null;
        $request['company_fixo'] = null;
        $request['cnpj'] = null;            
        $request['createtur'] = null;

        return $request;
    }

    private static function customRequestCompany($request, $user)
    {
        $request['cnpj']      = $request->cnpjcompany;
        $request['cpf']       = null;
        $request['rg']        = null;
        $request['createtur'] = $request->companyecreatetur;
        $request['name']      = $request->company;
        $request['phone']     = null;
        $request['fixo']      = null;
        $request['company_phone'] = $request->companyphone;
        $request['company_fixo'] = $request->companyfixo;
        $request['name']      = $request->company;
        $request['user_id']   = $user->id;

        return $request;
    }
}