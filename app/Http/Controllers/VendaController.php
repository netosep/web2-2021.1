<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\FormaPagamento;
use App\Models\ItemVenda;
use App\Models\PagamentoVenda;
use App\Models\Produto;
use App\Models\Venda;
use App\Validate\LoginValidate;
use Illuminate\Http\Request;

class VendaController extends Controller
{

    public function index()
    {
        if (LoginValidate::hasSession()) {
            return view('pages.venda.index', [
                'vendas' => Venda::with('cliente', 'pagamentovenda')->orderBy('id')->get()
            ]);
        } else {
            return redirect()->route('login.index');
        }
    }

    public function create()
    {
        if (LoginValidate::hasSession()) {
            return view('pages.venda.create', [
                'clientes' => Cliente::where('ativo', true)->orderBy('nome_cliente')->get(),
                'produtos' => Produto::where('ativo', true)->orderBy('nome_produto')->get(),
                'formas_pagamento' => FormaPagamento::all()->sortBy('id')
            ]);
        } else {
            return redirect()->route('login.index');
        }
    }

    public function store(Request $request)
    {
        if (LoginValidate::hasSession()) {
            $venda = new Venda();
            $venda->cliente_id = $request->cliente_id;
            $venda->funcionario_id = $request->funcionario_id;
            $venda->caixa_id = $request->caixa_id;
            $venda->save();

            for($i = 0; $i < count($request->produto_id); $i++) {
                $item_venda = new ItemVenda();
                $item_venda->venda_id = $venda->id;
                $item_venda->produto_id = $request->produto_id[$i];
                $item_venda->quantidade = $request->quantidade[$i];
                $item_venda->valor_unitario = $request->valor_unitario[$i];
                $item_venda->save();
            }

            $pagamento_venda = new PagamentoVenda();
            $pagamento_venda->venda_id = $venda->id;
            $pagamento_venda->forma_pagamento_id = $request->forma_pagamento_id;
            $pagamento_venda->parcelas = $request->parcelas;
            $pagamento_venda->save();

            return redirect()->route('venda.create')->with('success', 'Venda cadastrada com sucesso!');
        } else {
            return redirect()->route('login.index');
        }
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
