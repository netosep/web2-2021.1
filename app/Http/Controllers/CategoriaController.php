<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Validate\LoginValidate;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function index()
    {
        if (LoginValidate::hasSession()) {
            return view('pages.categoria.index', [
                'categorias' => Categoria::with('produtos')->where('ativo', true)->orderBy('id')->get()
            ]);
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
            Categoria::create($request->all());
            return redirect()->route('categoria.index')->with('success', 'Categoria cadastrada com sucesso!');
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
            return response()->json(Categoria::findOrFail($request->id_categoria));
        } else {
            return redirect()->route('login.index');
        }
    }

    public function update(Request $request)
    {
        if (LoginValidate::hasSession()) {
            Categoria::findOrFail($request->id_categoria)->update($request->all());
            return redirect()->route('categoria.index')->with('success', 'Categoria atualizada com sucesso!');
        } else {
            return redirect()->route('login.index');
        }
    }

    public function destroy($id)
    {
        if (LoginValidate::hasSession()) {
            Categoria::findOrFail($id)->update(['ativo' => false]);
            return redirect()->route('categoria.index')->with('success', 'Categoria excluída com sucesso!');
        } else {
            return redirect()->route('login.index');
        }
    }

}
