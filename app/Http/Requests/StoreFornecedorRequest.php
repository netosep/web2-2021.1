<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFornecedorRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|max:255|string',
            'telefone' => 'required|numeric|max:15',
            'endereco' => 'required|max:100'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O campo nome deve ter no máximo :max caracteres.',
            'nome.string' => 'O campo nome deve conter numeros.',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.numeric' => 'O campo telefone deve conter apenas numeros.',
            'telefone.max' => 'O campo telefone deve ter no máximo :max caracteres.',
            'endereco.required' => 'O campo endereço é obrigatório.',
            'endereco.max' => 'O campo endereço deve ter no máximo :max caracteres.'
        ];
    }
}
