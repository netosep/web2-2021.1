<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    public function index() {
        return view('produtos.index', ['produtos' => Produto::all()]);
    }

    public function create() {
        return view('produtos.create');
    }

    public function store(Request $request) {
        $produto = new Produto();
        $produto->nome = $request->nome;
        $produto->porcentagem_lucro = $request->lucro;
        $produto->save();

        return redirect('/produtos/index');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $produto = Produto::find($id);
        return view('produtos.edit', ['produto' => $produto]);
    }

    public function update(Request $request, $id) {
        Produto::find($id)->update($request->all());
        return redirect('/produtos/index');
    }

    public function destroy($id) {
        Produto::find($id)->delete();
        return redirect('/produtos/index');
    }
}
