<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\FormaPagamento;
use App\Models\ItemVenda;
use App\Models\PagamentoVenda;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{

    public function index()
    {
        return view('pages.venda.index', [
            'vendas' => Venda::with('cliente', 'pagamentovenda')->orderBy('id')->get()
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
        $venda = Venda::create($request->all());

        for($i = 0; $i < count($request->produto_id); $i++) {
            ItemVenda::create([
                'venda_id' => $venda->id,
                'produto_id' => $request->produto_id[$i],
                'quantidade' => $request->quantidade[$i],
                'valor_unitario' => $request->valor_unitario[$i]
            ]);
        }

        PagamentoVenda::create([
            'venda_id' => $venda->id,
            'forma_pagamento_id' => $request->forma_pagamento_id,
            'parcelas' => $request->parcelas
        ]);

        //dd(Venda::with('cliente', 'pagamentovenda')->find($venda->id)->toArray());

        return redirect()->route('venda.create', [
            //'venda' => Venda::with('cliente', 'pagamentovenda')->find($venda->id)
        ])->with('success', 'Venda cadastrada com sucesso!');
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
        Venda::findOrFail($id)->delete();
        return redirect()->route('venda.index')->with('success', 'Venda removida com sucesso!');
    }
}
