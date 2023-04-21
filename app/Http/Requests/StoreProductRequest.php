<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'type_product_id' => 'required',
            'amount' => 'required',
            'status' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo Nome é obrigatório',
            'type_product_id.required' => 'O campo Tipo é obrigatório',
            'amount.required' => 'O campo A partir de: é obrigatório',
            'description.required' => 'O campo Descrição é obrigatório',
        ];
    }
}
