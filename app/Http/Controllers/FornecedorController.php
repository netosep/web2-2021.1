<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Validate\LoginValidate;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{

    public function index()
    {
        if (LoginValidate::hasSession()) {
            return view('pages.fornecedor.index', [
                'fornecedores' => Fornecedor::all()->where('ativo', true)->sortBy('id')
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
            Fornecedor::create($request->all());
            return redirect()->route('fornecedor.index')->with('success', 'Fornecedor cadastrado com sucesso!');
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
            return response()->json(Fornecedor::findOrFail($request->id_fornecedor));
        } else {
            return redirect()->route('login.index');
        }
    }

    public function update(Request $request)
    {
        if (LoginValidate::hasSession()) {
            Fornecedor::findOrFail($request->id_fornecedor)->update($request->all());
            return redirect()->route('fornecedor.index')->with('success', 'Fornecedor atualizado com sucesso!');
        } else {
            return redirect()->route('login.index');
        }
    }

    public function destroy($id)
    {
        if (LoginValidate::hasSession()) {
            Fornecedor::findOrFail($id)->update(['ativo' => false]);
            return redirect()->route('fornecedor.index')->with('success', 'Fornecedor excluido com sucesso!');
        } else {
            return redirect()->route('login.index');
        }
    }
}
