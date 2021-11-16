<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NomeCompleto implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        return str_word_count($value) >= 2;
    }

    public function message()
    {
        return 'É necessário informar o nome completo.';
    }
}
