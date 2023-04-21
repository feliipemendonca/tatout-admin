<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        try {
            return parent::toArray($request);
        } catch (\Throwable $th) {
            throw $th;
        }
        

        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
