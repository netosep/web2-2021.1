<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\FormaPagamento;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{

    public function index()
    {
        return view('pages.venda.index', [
            'vendas' => Venda::with('cliente', 'forma_pagamento')->orderBy('id')->get(),
        ]);
    }

    public function create()
    {
        return view('pages.venda.create', [
            'clientes' => Cliente::where('ativo', true)->orderBy('nome_cliente')->get(),
            'produtos' => Produto::where('ativo', true)->orderBy('nome_produto')->get(),
            'formas_pagamento' => FormaPagamento::all()->sortBy('id')
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
