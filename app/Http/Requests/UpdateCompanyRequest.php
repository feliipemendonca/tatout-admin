<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\CPFCNPJ;
use App\Rules\PhoneBr;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
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
        // dd($this->company);
        return [
            'company' => 'required', 'string', 'max:255',
            'name' => 'required', 'string', 'max:255',
            // 'email' => 'required', 'string', 'email', 'max:255','unique:users,email,'.$this->company->user->id,
            // 'password' => 'min:8',
            'status_id' =>  'required', 'integer',
            'zip' => 'required', 'string', 'max:255',
            'address'  => 'required', 'string', 'max:255', 
            'complement'  => 'max:255', 
            'number'  => 'required', 'string', 'integer', 
            'district'  => 'required', 'string', 'max:255', 
            'city'  => 'required', 'string', 'max:255', 
            'state'  => 'required', 'string', 'max:255',
            'createtur' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'             => 'O campo Nome é obrigatório',
            'email.required'            => 'O campo E-mail é obrigatório',
            'email.email'               => 'Digite E-mail válido',
            'email.unique'              => 'Já existe registro de E-mail',
            'password.required'         => 'O campo Senha é obrigatório',
            'password.min'              => 'Minímo 8 caracteres',
            'phone.required'            => 'O campo Celular é obrigatório',
            'company_phone.required'    => 'O campo Celular é obrigatório',
            'company_phone.unique'      => 'Já existe registro de Celular',
            'phone.unique'              => 'Já existe registro de Celular',
            'cpf.required'              => 'O campo CPF é obrigatório',
            'cpf.unique'                => 'Já existe registro de CPF',
            'cnpj.required'             => 'O campo CNPJ é obrigatório',
            'cnpj.unique'               => 'Já existe registro de CNPJ',
            'rg.required'               => 'O campo RG é obrigatório',
            'rg.unique'                 => 'á existe registro de RG',
            'status_id.required'        => 'O campo Status é obrigatório',
            'zip.required'              => 'O campo Cep é obrigatório',
            'fixo.required'             => 'O campo Fixo é obrigatório',
            'fixo.unique'               => 'Fixo já existe',
            'state.required'            => 'O campo Estado é obrigatório',
            'city.required'             => 'O campo Cidade é obrigatório',
            'number.required'           => 'O campo Número é obrigatório',
            'district.required'         => 'O campo Bairro é obrigatório',
            'address.required'          => 'O campo Endereço é obrigatório',
            'createtur.required'        => 'O campo CadastraTur é obrigatório',
            'company.required'          => 'O campo Fornecedor é obrigatório',
        ];
    }
}
