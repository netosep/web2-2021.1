<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompraRequest;
use App\Models\Compra;
use App\Models\Fornecedor;
use App\Models\ItemCompra;
use App\Models\Produto;
use Illuminate\Http\Request;

class CompraController extends Controller
{

    public function index() {
        return view('compras.index', ['compras' => Compra::all()->sortBy('id')]);
    }

    public function create() {
        return view('compras.create', [
            'produtos' => Produto::all()->sortBy('nome'),
            'fornecedores' => Fornecedor::all()->sortBy('nome')
        ]);
    }

    public function store(StoreCompraRequest $request) {
        $valorTotal = 0;
        $quantidades = $request->quantidade;
        $produtos = $request->produto_id;
        $valores = $request->valor_compra;

        for($i = 0; $i < count($produtos); $i++) { 
            $valorTotal += $quantidades[$i] * $valores[$i];
        }

        $compra = new Compra();
        $compra->fornecedor_id = $request->fornecedor_id;
        $compra->valor_total = $valorTotal;
        $compra->save();

        for ($i = 0; $i < count($produtos); $i++) { 
            $itensCompra = new ItemCompra();
            $itensCompra->compra_id = $compra->id;
            $itensCompra->produto_id = $produtos[$i];
            $itensCompra->quantidade = $quantidades[$i];
            $itensCompra->valor_unitario = $valores[$i];
            $itensCompra->valor_total = $valores[$i] * $quantidades[$i];
            $itensCompra->save();

            $produto = Produto::findOrFail($produtos[$i]);
            $produto->valor_compra = $valores[$i];
            $produto->valor_venda = $valores[$i] * ($produto->porcentagem_lucro / 100) + $valores[$i];
            $produto->quantidade += $quantidades[$i];
            $produto->save();
        }

        return redirect()->route('compras.index');
    }

    public function show($id) {
        $compra = Compra::select(
            'fornecedores.nome as nome_fornecedor',
            'produtos.nome as nome_produto',
            'itens_compra.quantidade as quantidade',
            'itens_compra.valor_unitario as valor_unitario',
            'itens_compra.valor_total as valor_total',
            'compras.valor_total as valor_total_compra'
        )
        ->join('fornecedores', 'fornecedores.id', '=', 'compras.fornecedor_id')
        ->join('itens_compra', 'itens_compra.compra_id', '=', 'compras.id')
        ->join('produtos', 'produtos.id', '=', 'itens_compra.produto_id')
        ->where('compras.id', '=', $id) 
        ->get();

        return view('compras.show', ['compra' => $compra]);
    }

    public function edit($id) {
        $compra = Compra::findOrFail($id);
        $compra->fornecedor = $compra->fornecedor()->get();
        $compra->itensCompra = $compra->itensCompra()->get();

        return view('compras.edit', [
            'compra' => $compra,
            'produtos' => Produto::all()->sortBy('nome'),
            'fornecedores' => Fornecedor::all()->sortBy('nome')
        ]);
    }

    public function update(StoreCompraRequest $request, $id) {
        $valorTotal = 0;
        $quantidades = $request->quantidade;
        $produtos = $request->produto_id;
        $valores = $request->valor_compra;

        for($i = 0; $i < count($produtos); $i++) { 
            $valorTotal += $quantidades[$i] * $valores[$i];
        }

        $compra = Compra::findOrFail($id);
        $compra->fornecedor_id = $request->fornecedor_id;
        $compra->valor_total = $valorTotal;
        $compra->save();

        // apagando todos os ItemCompra do banco com o id da compra
        ItemCompra::where('compra_id', $id)->delete();

        // criando novos registros de ItemCompra
        for ($i = 0; $i < count($produtos); $i++) { 
            $itensCompra = new ItemCompra();
            $itensCompra->compra_id = $compra->id;
            $itensCompra->produto_id = $produtos[$i];
            $itensCompra->quantidade = $quantidades[$i];
            $itensCompra->valor_unitario = $valores[$i];
            $itensCompra->valor_total = $valores[$i] * $quantidades[$i];
            $itensCompra->save();

            $produto = Produto::findOrFail($produtos[$i]);
            $produto->valor_compra = $valores[$i];
            $produto->valor_venda = $valores[$i] * ($produto->porcentagem_lucro / 100) + $valores[$i];
            $produto->quantidade += $quantidades[$i];
            $produto->save();
        }

        return redirect()->route('compras.index');
    }

    public function destroy($id) {
        Compra::findOrFail($id)->delete($id);
        return redirect()->route('compras.index');
    }
}
