<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ItemVenda;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{

    public function index() {
        return view('vendas.index', ['vendas' => Venda::all()]);
    }

    public function create() {
        return view('vendas.create', [
            'produtos' => Produto::all(), 
            'clientes' => Cliente::all()
        ]);
    }

    public function store(Request $request) {

        // concertar para varios produtos
        $venda = new Venda();
        $venda->cliente_id = $request->cliente_id;
        $venda->valor_total = Produto::find($request->produto_id[0])->valor_venda * $request->quantidade[0];
        $venda->save();

        for ($i = 0; $i < count($request->quantidade); $i++) { 
            $itensVenda = new ItemVenda();
            $itensVenda->venda_id = $venda->id;
            $itensVenda->produto_id = $request->produto_id[$i];
            $itensVenda->quantidade = $request->quantidade[$i];
            $itensVenda->valor_unitario = Produto::find($request->produto_id[$i])->valor_venda;
            $itensVenda->valor_total = $itensVenda->valor_unitario * $itensVenda->quantidade;
            $itensVenda->save();
        }

        return redirect()->route('vendas.index');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        
    }

    public function update(Request $request, $id) {
        Venda::find($id)->update($request->all());
        return redirect()->route('vendas.index');
    }

    public function destroy($id) {
        Venda::find($id)->delete();
        return redirect()->route('vendas.index');
    }
}
