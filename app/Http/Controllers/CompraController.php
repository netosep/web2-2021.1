<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\FormaPagamento;
use App\Models\Fornecedor;
use App\Models\ItemCompra;
use App\Models\PagamentoCompra;
use App\Models\Produto;
use Illuminate\Http\Request;

class CompraController extends Controller
{

    public function index()
    {
        return view('pages.compra.index', [
            'compras' => Compra::with('fornecedor', 'funcionario')->orderBy('id')->get()
        ]);
    }

    public function create()
    {
        return view('pages.compra.create', [
            'fornecedores' => Fornecedor::all()->sortBy('nome_fornecedor'),
            'produtos' => Produto::where('ativo', true)->orderBy('nome_produto')->get(),
            'formas_pagamento' => FormaPagamento::all()->sortBy('id')
        ]);
    }

    public function store(Request $request)
    {
        $compra = Compra::create($request->all());

        for($i = 0; $i < count($request->produto_id); $i++) {
            ItemCompra::create([
                'compra_id' => $compra->id,
                'produto_id' => $request->produto_id[$i],
                'ipi' => $request->ipi[$i],
                'icms' => $request->icms[$i],
                'frete' => $request->frete[$i],
                'valor_compra' => $request->valor_compra[$i],
                'quantidade' => $request->quantidade[$i]
            ]);
        }

        PagamentoCompra::create([
            'compra_id' => $compra->id,
            'forma_pagamento_id' => $request->forma_pagamento_id,
            'parcelas' => $request->parcelas
        ]);

        return redirect()->route('compra.create', [
            //'compra' => Compra::with('fornecedor', 'pagamentocompra')->find($compra->id)
        ])->with('success', 'Compra cadastrada com sucesso!');

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
        Compra::findOrFail($id)->delete();
        return redirect()->route('compra.index')->with('success', 'Compra excluída com sucesso!');
    }
}
