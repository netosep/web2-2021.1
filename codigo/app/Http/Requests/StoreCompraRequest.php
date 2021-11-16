<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompraRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fornecedor_id' => 'required',
            'produto_id' => 'required',
            'quantidade' => 'required',
            'valor' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'fornecedor_id.required' => 'O campo fornecedor é obrigatório.',
            'produto_id.required' => 'O campo produto é obrigatório.',
            'quantidade.required' => 'O campo quantidade é obrigatório.',
            'quantidade.numeric' => 'O campo quantidade deve ser numérico.',
            'valor.required' => 'O campo valor é obrigatório.'
        ];
    }
}
