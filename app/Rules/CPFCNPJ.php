<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CPFCNPJ implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $onlyNumbers = preg_replace('/([^\d]+)/', '', $value);
        return (strlen($onlyNumbers) == 11 || strlen($onlyNumbers) == 14);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Digite um CNPJ válido';
    }
}
