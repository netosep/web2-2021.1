<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdutoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|max:200',
            'lucro' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome do produto é obrigatório.',
            'nome.max' => 'O nome do produto deve ter no máximo :max caracteres.',
            'lucro.required' => 'O lucro do produto é obrigatório.',
            'lucro.numeric' => 'O lucro do produto deve ser um número.'
        ];
    }
}
