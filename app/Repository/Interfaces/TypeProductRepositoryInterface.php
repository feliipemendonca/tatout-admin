<?php

namespace App\Repository\Interfaces;


interface TypeProductRepositoryInterface 
{
    public function all();
    public function find($id);
    public function store($request);
    public function update($id, $request);
    public function delete($id);
}