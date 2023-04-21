<?php

namespace App\Repository\Interfaces;

interface UserRepositoryInterface 
{
    public function all();
    public function suppliers();
    public function find($id);
    public function store($request);
    public function update($id, $request);
    public function delete($id);
    public function sellersCompany($company);
    public function allSellers();
}