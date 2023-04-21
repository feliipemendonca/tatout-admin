<?php

namespace App\Repository\Interfaces;

interface AvailabilityRepositoryInterface 
{
    public function all();
    public function suppliers();
    public function find($id);
    public function store($request, $id);
    public function update($id, $request);
    public function delete($id);
}