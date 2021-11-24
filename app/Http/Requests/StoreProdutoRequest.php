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
            'nome' => 'required|min:3|max:100',
            'porcentagem_lucro' => 'required|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome do produto é obrigatório.',
            'nome.min' => 'O nome do produto deve ter no mínimo :min caracteres.',
            'nome.max' => 'O nome do produto deve ter no máximo :max caracteres.',
            'porcentagem_lucro.required' => 'O lucro do produto é obrigatório.',
            'porcentagem_lucro.numeric' => 'O lucro do produto deve ser um número.',
            'porcentagem_lucro.min' => 'O lucro do produto deve ser no mínimo :min.'
        ];
    }
}
