<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVendaRequest;
use App\Models\Cliente;
use App\Models\ItemVenda;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{

    public function index() {
        return view('vendas.index', ['vendas' => Venda::all()->sortBy('id')]);
    }

    public function create() {
        return view('vendas.create', [
            'produtos' => Produto::all()->sortBy('nome'), 
            'clientes' => Cliente::all()->sortBy('nome')
        ]);
    }

    public function store(StoreVendaRequest $request) {
        $valorTotal = 0;
        $quantidades = $request->quantidade;
        $produtos = $request->produto_id;

        for($i = 0; $i < count($produtos); $i++) { 
            $valorTotal += Produto::find($produtos[$i])->valor_venda * $quantidades[$i];
        }

        $venda = new Venda();
        $venda->cliente_id = $request->cliente_id;
        $venda->valor_total = $valorTotal;
        $venda->save();

        for($i = 0; $i < count($produtos); $i++) { 
            $itemVenda[$i] = new ItemVenda();
            $itemVenda[$i]->venda_id = $venda->id;
            $itemVenda[$i]->produto_id = $produtos[$i];
            $itemVenda[$i]->quantidade = $quantidades[$i];
            $itemVenda[$i]->valor_unitario = Produto::find($produtos[$i])->valor_venda;
            $itemVenda[$i]->valor_total = $itemVenda[$i]->valor_unitario * $itemVenda[$i]->quantidade;
            $itemVenda[$i]->save();

            $produto = Produto::findOrFail($produtos[$i]);
            $produto->quantidade -= $quantidades[$i];
            $produto->save();
        }

        return redirect()->route('vendas.index');
    }

    public function show($id) {
        $venda = Venda::select(
            'clientes.nome as nome_cliente',
            'produtos.nome as nome_produto',
            'itens_venda.quantidade as quantidade',
            'itens_venda.valor_unitario as valor_unitario',
            'itens_venda.valor_total as valor_total',
            'vendas.valor_total as valor_total_venda'
        )
        ->join('clientes', 'clientes.id', '=', 'vendas.cliente_id')
        ->join('itens_venda', 'itens_venda.venda_id', '=', 'vendas.id')
        ->join('produtos', 'produtos.id', '=', 'itens_venda.produto_id')
        ->where('vendas.id', '=', $id)
        ->get();
        
        return view('vendas.show', ['venda' => $venda]);
    }

    public function edit($id) {
        $venda = Venda::find($id);
        $venda->cliente = $venda->cliente()->get();
        $venda->itensVenda = $venda->itensVenda()->get();

        return view('vendas.edit', [
            'venda' => $venda,
            'produtos' => Produto::all()->sortBy('nome'), 
            'clientes' => Cliente::all()->sortBy('nome')
        ]);
    }

    public function update(StoreVendaRequest $request, $id) {
        $valorTotal = 0;
        $quantidades = $request->quantidade;
        $produtos = $request->produto_id;

        for($i = 0; $i < count($produtos); $i++) { 
            $valorTotal += Produto::findOrFail($produtos[$i])->valor_venda * $quantidades[$i];
        }

        $venda = Venda::findOrFail($id);
        $venda->cliente_id = $request->cliente_id;
        $venda->valor_total = $valorTotal;
        $venda->save();

        // apagando todos os ItemVenda do banco com o id da venda
        ItemVenda::where('venda_id', '=', $id)->delete();

        // criando novos registros de ItemVenda
        for($i = 0; $i < count($produtos); $i++) { 
            $itemVenda[$i] = new ItemVenda();
            $itemVenda[$i]->venda_id = $venda->id;
            $itemVenda[$i]->produto_id = $produtos[$i];
            $itemVenda[$i]->quantidade = $quantidades[$i];
            $itemVenda[$i]->valor_unitario = Produto::findOrFail($produtos[$i])->valor_venda;
            $itemVenda[$i]->valor_total = $itemVenda[$i]->valor_unitario * $itemVenda[$i]->quantidade;
            $itemVenda[$i]->save();
        }

        return redirect()->route('vendas.index');
    }

    public function destroy($id) {
        Venda::findOrFail($id)->delete();
        return redirect()->route('vendas.index');
    }
}
