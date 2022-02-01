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
        if (LoginValidate::hasSession()) {
            return view('pages.produto.index', [
                'produtos' => Produto::with('categoria')->where('ativo', true)->orderBy('id')->get(),
                'categorias' => Categoria::all()->where('ativo', true)->sortBy('nome_categoria')
            ]);
        } else {
            return redirect()->route('login.index');
        }
    }

    public function getAll()
    {
        if (LoginValidate::hasSession()) {
            return response()->json(Produto::all()->where('ativo', true)->sortBy('id'));
        } else {
            return redirect()->route('login.index');
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if (LoginValidate::hasSession()) {
            Produto::create($request->all());
            return redirect()->route('produto.index')->with('success', 'Produto cadastrado com sucesso!');
        } else {
            return redirect()->route('login.index');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request)
    {
        if (LoginValidate::hasSession()) {
            return response()->json(Produto::findOrFail($request->id_produto));
        } else {
            return redirect()->route('login.index');
        }
    }

    public function update(Request $request)
    {
        if (LoginValidate::hasSession()) {
            Produto::findOrFail($request->id_produto)->update($request->all());
            return redirect()->route('produto.index')->with('success', 'Produto atualizado com sucesso!');
        } else {
            return redirect()->route('login.index');
        }
    }

    public function destroy($id)
    {
        if (LoginValidate::hasSession()) {
            Produto::findOrFail($id)->update(['ativo' => false]);
            return redirect()->route('produto.index')->with('success', 'Produto removido com sucesso!');
        } else {
            return redirect()->route('login.index');
        }
    }
}
