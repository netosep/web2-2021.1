<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFornecedorRequest;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index() {
        return view('fornecedores.index', ['fornecedores' => Fornecedor::all()->sortBy('id')]);
    }

    public function create() {
        return view('fornecedores.create');
    }

    public function store(StoreFornecedorRequest $request) {
        Fornecedor::create($request->all());
        return redirect()->route('fornecedores.index');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $fornecedor = Fornecedor::find($id);
        return view('fornecedores.edit', ['fornecedor' => $fornecedor]);
    }

    public function update(StoreFornecedorRequest $request, $id) {
        Fornecedor::findOrFail($id)->update($request->all());
        return redirect()->route('fornecedores.index');
    }

    public function destroy($id) {
        Fornecedor::findOrFail($id)->delete();
        return redirect()->route('fornecedores.index');
    }
}
