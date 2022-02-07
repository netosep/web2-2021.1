<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{

    public function index()
    {
        return view('pages.fornecedor.index', [
            'fornecedores' => Fornecedor::all()->where('ativo', true)->sortBy('id')
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Fornecedor::create($request->all());
        return redirect()->route('fornecedor.index')->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request)
    {
        return response()->json(Fornecedor::findOrFail($request->id_fornecedor));
    }

    public function update(Request $request)
    {
        Fornecedor::findOrFail($request->id_fornecedor)->update($request->all());
        return redirect()->route('fornecedor.index')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Fornecedor::findOrFail($id)->update(['ativo' => false]);
        return redirect()->route('fornecedor.index')->with('success', 'Fornecedor excluido com sucesso!');
    }
}
