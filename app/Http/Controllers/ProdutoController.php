<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use App\Validate\LoginValidate;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    public function index()
    {
        return view('pages.produto.index', [
            'produtos' => Produto::with('categoria')->where('ativo', true)->orderBy('id')->get(),
            'categorias' => Categoria::all()->where('ativo', true)->sortBy('nome_categoria')
        ]);
    }

    public function getAll()
    {
        return response()->json(Produto::all()->where('ativo', true)->sortBy('id'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Produto::create($request->all());
        return redirect()->route('produto.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request)
    {
        return response()->json(Produto::findOrFail($request->id_produto));
    }

    public function update(Request $request)
    {
        Produto::findOrFail($request->id_produto)->update($request->all());
        return redirect()->route('produto.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Produto::findOrFail($id)->update(['ativo' => false]);
        return redirect()->route('produto.index')->with('success', 'Produto removido com sucesso!');
    }
}
