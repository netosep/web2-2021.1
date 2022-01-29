<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function index()
    {
        return view('pages.categoria.index', [
            'categorias' => Categoria::with('produtos')->where('ativo', true)->orderBy('id')->get()
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Categoria::create($request->all());
        return redirect()->route('categoria.index')->with('success', 'Categoria cadastrada com sucesso!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request)
    {
        return response()->json(Categoria::findOrFail($request->id_categoria));
    }

    public function update(Request $request)
    {
        Categoria::findOrFail($request->id_categoria)->update($request->all());
        return redirect()->route('categoria.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy($id)
    {
        Categoria::findOrFail($id)->update(['ativo' => false]);
        return redirect()->route('categoria.index')->with('success', 'Categoria excluída com sucesso!');
    }

}
