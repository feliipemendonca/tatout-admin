<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAvailabilityRequest;
use App\Http\Requests\UpdateAvailabilityRequest;
use App\Models\Product;
use App\Models\Status;
use App\Models\TypePrice;
use App\Repository\Interfaces\AvailabilityRepositoryInterface;
use App\Repository\Interfaces\ProductRepositoryInterface;

class AvailabilityController extends Controller
{
    private ProductRepositoryInterface $product;
    private AvailabilityRepositoryInterface $repository;

    public function __construct(AvailabilityRepositoryInterface $repository, ProductRepositoryInterface $product)
    {
        $this->product = $product;
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $this->authorize('viewAny', Product::class);
        return view('dashboard.availability.index',[
            'item' => $this->product->find($id)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $this->authorize('create', Product::class);
        return view('dashboard.availability.create',[
            'item' => $this->product->find($id),
            'types' => TypePrice::all(),
            'status' => Status::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAvailabilityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAvailabilityRequest $request, $id)
    {
        $this->authorize('create', Product::class);
        return $this->repository->store($request, $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Availability  $availability
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($this->product->find($id));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Availability  $availability
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->repository->find($id); 
        $this->authorize('update', $model->availabisable);

        return view('dashboard.availability.edit',[
            'item' => $model,
            'types' => TypePrice::all(),
            'status' => Status::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAvailabilityRequest  $request
     * @param  \App\Models\Availability  $availability
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAvailabilityRequest $request, $id)
    {
        $this->authorize('update', $this->repository->find($id)->availabisable);
        return $this->repository->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Availability  $availability
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', $this->repository->find($id)->availabisable);
        return $this->repository->delete($id);
    }
}
