<?php

namespace App\Repository;

use App\Helpers\UploadHelper;
use App\Models\Company;
use App\Models\File;
use App\Models\Product;
use App\Repository\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface 
{
    private $model, $company;

    public function __construct(Product $model, Company $company)
    {
        $this->model = $model;
        $this->company = $company;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findApi($id)
    {
        return $this->model->customBuildQueryFindProduct($id);
    }

    public function all() 
    {
        return $this->model;
    }

    public function allApi()
    {
        return $this->model->customBuildQueryAllProducts();
    }

    public function productsId($company)
    {
        $products = $company->products()->select('id')->get();
        $ids = [];
        foreach ($products as $key => $value) {
            $ids[$key] = $value->id;
        }

        return $ids;
    }

    public function store($request)
    {
        $company = $this->company->find($request->company_id);
        DB::beginTransaction();
        
        try {
            $model = $company->products()->create($request->all());
            $this->upload($model, $request->file);

        } catch (\Throwable $th) {
            throw $th;
            return back()->with('error','Erro ao cadastrar tipo de produto. Por favor entre em contato com o suporte!');
        }
        DB::commit();

        return redirect()->route('dashboard.passeios.index')->with('success','Tipo de produto Cadastrado com sucesso!');
    }

    public function update($id, $request)
    {
        $model = self::find($id);
        DB::beginTransaction();
        try {
            $model->setData($model, $request->all());
            $model->save();

            if($request->file)
                $this->upload($model, $request->file); 

        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error','Erro ao atualizar tipo de produto. Por favor entre em contato com o suporte!');
        }
        DB::commit();

        return redirect()->route('dashboard.passeios.index')->with('success','Tipo de produto atualizado com sucesso!');
    }

    public function delete($id)
    {
        try {
            self::find($id)->delete();
        } catch (\Throwable $th) {
            throw $th;

            return back()->with('error','Erro ao apagar tipo de produto. Por favor entre em contato com o suporte!');
        }

        return redirect()->route('dashboard.passeios.index')->with('success','Tipo de produto apagado com sucesso!');
    }

    public function upload($model, $file)
    {
        foreach($file as $item):
            $upload = new UploadHelper($item);
            $upload->uploadImage($upload);
            $model->file()->create([
                'name' => $upload->getFileName(),
                'path'  => '/storage/' . $upload->getFileName(),
            ]);
        endforeach;
    }

    public function removeFile($id)
    {
        DB::beginTransaction();
        try {
            $file = File::find($id);
            $file->delete();

        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(['error' => $th]);
        }
        DB::commit();

        return response()->json(['success' => 'Imagem Removida com sucesso']);
    }
}