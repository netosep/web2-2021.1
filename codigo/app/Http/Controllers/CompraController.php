<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Fornecedor;
use App\Models\ItemCompra;
use App\Models\Produto;
use Illuminate\Http\Request;

class CompraController extends Controller
{

    public function index() {
        return view('compras.index', [
            'compras' => Compra::all()
        ]);
    }

    public function create() {
        return view('compras.create', [
            'produtos' => Produto::all(),
            'fornecedores' => Fornecedor::all()
        ]);
    }

    public function store(Request $request) {

        // concertar para varios produtos
        $compra = new Compra();
        $compra->fornecedor_id = $request->fornecedor_id;
        $compra->valor_total = Produto::find($request->produto_id[0])->valor_compra * $request->quantidade[0];
        $compra->save();

        for ($i = 0; $i < count($request->quantidade); $i++) { 
            $itensCompra = new ItemCompra();
            $itensCompra->compra_id = $compra->id;
            $itensCompra->produto_id = $request->produto_id[$i];
            $itensCompra->quantidade = $request->quantidade[$i];
            $itensCompra->valor_unitario = Produto::find($request->produto_id[$i])->valor_compra;
            $itensCompra->valor_total = $itensCompra->valor_unitario * $itensCompra->quantidade;
            $itensCompra->save();
        }

        return redirect()->route('compras.index');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        Compra::destroy($id);
        return redirect()->route('compra.index');
    }
}
