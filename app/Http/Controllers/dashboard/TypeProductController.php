<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeProductRequest;
use App\Http\Requests\UpdateTypeProductRequest;
use App\Models\TypeProduct;
use App\Repository\Interfaces\TypeProductRepositoryInterface;

class TypeProductController extends Controller
{
    private TypeProductRepositoryInterface $repository;

    public function __construct(TypeProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Company::class);

        return view('dashboard.typeproduct.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Company::class);
        return view('dashboard.typeproduct.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTypeProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeProductRequest $request)
    {
        $this->authorize('create', Company::class);
        return $this->repository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function show(TypeProduct $typeProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->repository->find($id); 
        $this->authorize('update', $model);

        return view('dashboard.typeproduct.edit',[
            'item' => $model
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTypeProductRequest  $request
     * @param  \App\Models\TypeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeProductRequest $request, $id)
    {
        $this->authorize('update', $this->repository->find($id));
        return $this->repository->update($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', $this->repository->find($id));
        return $this->repository->delete($id);
    }
}
