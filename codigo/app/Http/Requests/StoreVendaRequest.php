<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendaRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cliente_id' => 'required',
            'produto_id' => 'required',
            'quantidade' => 'required',
            'valor' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'cliente_id.required' => 'O campo cliente é obrigatório.',
            'produto_id.required' => 'O campo produto é obrigatório.',
            'quantidade.required' => 'O campo quantidade é obrigatório.'
        ];
    }
}
