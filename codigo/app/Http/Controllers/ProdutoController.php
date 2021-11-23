<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutoRequest;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    public function index() {
        return view('produtos.index', ['produtos' => Produto::all()->sortBy('id')]);
    }

    public function create() {
        return view('produtos.create');
    }

    public function store(StoreProdutoRequest $request) {
        Produto::create($request->all());
        return redirect()->route('produtos.index');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $produto = Produto::findOrFail($id);
        return view('produtos.edit', ['produto' => $produto]);
    }

    public function update(StoreProdutoRequest $request, $id) {
        Produto::findOrFail($id)->update($request->all());
        return redirect()->route('produtos.index');
    }

    public function destroy($id) {
        Produto::findOrFail($id)->delete();
        return redirect()->route('produtos.index');
    }
}
