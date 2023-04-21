<?php
namespace App\Helpers;


use Illuminate\Support\Facades\Validator;

class Validations{
    
    public function getValidator($attribute, $rules = [])
    {
        Validator::extend('phone_br', function ($attribute, $value, $parameters, $validator) {
            $onlyNumbers = preg_replace('/([^\d]+)/', '', $value);
            return in_array(strlen($onlyNumbers), [10, 11]);
        });

        Validator::extend('cpf', function ($attribute, $value, $parameters, $validator) {
            $onlyNumbers = preg_replace('/([^\d]+)/', '', $value);
            return (strlen($onlyNumbers) == 11);
        });

        $messages = [
            'required' => 'O campo ":attribute" é obrigatório.',
            'required_if' => 'O campo ":attribute" é obrigatório.',
            'max' => 'O campo ":attribute" deve ter no máximo :max caracteres.',
            'phone_br' => 'O campo ":attribute" deve ser preenchido com DDD e o número com 8 ou 9 dígitos.',
            'present' => 'Você precisa confirmar o preenchimento correto do formulário.',
            'email' => 'O email informado é inválido.',
            'unique' => 'Já existe esse registro.',
        ];

        $attribute = $this->translateAttribute($attribute);
        $validator = Validator::make($attribute, $rules, $messages);
        
        return $validator;
    }

    public function translateAttribute($attribute)
    {
        $new = [];

        foreach($attribute as $key =>  $item) {

            switch ($key) {
                case 'name':
                    $new[$key] = "Nome";
                    break;
                case 'email':
                    $new[$key] = "E-mail";
                    break;
                case 'password':
                    $new[$key] = "Senha";
                    break;
                case 'phone':
                    $new[$key] = "Celular";
                    break;
                case 'fixo':
                    $new[$key] = "Fixo";
                    break;
                case 'cpf':
                    $new[$key] = "CPF";
                    break;
                case 'rg':
                    $new[$key] = "RG";
                    break;
                case 'status_id':
                    $new[$key] = "Status";
                    break;
                case 'zip':
                    $new[$key] = "Cep";
                    break;
                case 'address':
                    $new[$key] = "Endereço";
                    break;
                case 'complement':
                    $new[$key] = "Complemento";
                    break;
                case 'number':
                    $new[$key] = "Número";
                    break;
                case 'district':
                    $new[$key] = "Distrito";
                    break;
                case 'city':
                    $new[$key] = "Cidade";
                    break;
                case 'State':
                    $new[$key] = "Estado";
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        return array_flip($new);
    }
}





