<?php

namespace App\Repository\Interfaces;


interface RoleRepositoryInterface 
{
    public function all();
    public function find($id);
    public function store($request);
    public function update($id, $request);
    public function delete($id);
}