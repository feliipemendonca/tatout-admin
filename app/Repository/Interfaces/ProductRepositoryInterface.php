<?php

namespace App\Repository\Interfaces;


interface ProductRepositoryInterface 
{
    public function all();
    public function find($id);
    public function store($request);
    public function update($id, $request);
    public function delete($id);
    public function removeFile($id);
    public function productsId($company);

    public function allApi();
    public function findApi($id);
}