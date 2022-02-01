<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use App\Validate\LoginValidate;
use Illuminate\Http\Request;

class CaixaController extends Controller
{

    public function index()
    {
        if (LoginValidate::hasSession()) {
            return view('pages.caixa.index', ['caixas' => Caixa::all()->sortBy('id')]);
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
            Caixa::create($request->all());
            return redirect()->route('caixa.index')->with('success', 'Caixa criado com sucesso!');
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
            return response()->json(Caixa::findOrFail($request->id_caixa));
        } else {
            return redirect()->route('login.index');
        }
    }

    public function update(Request $request)
    {
        if (LoginValidate::hasSession()) {
            Caixa::findOrFail($request->id_caixa)->update($request->all());
            return redirect()->route('caixa.index')->with('success', 'Caixa atualizado com sucesso!');
        } else {
            return redirect()->route('login.index');
        }
    }

    public function ativar($id)
    {
        if (LoginValidate::hasSession()) {
            Caixa::findOrFail($id)->update(['ativo' => true]);
            return redirect()->route('caixa.index')->with('success', 'Caixa ativado com sucesso!');
        } else {
            return redirect()->route('login.index');
        }
    }

    public function desativar($id)
    {
        if (LoginValidate::hasSession()) {
            Caixa::findOrFail($id)->update(['ativo' => false]);
            return redirect()->route('caixa.index')->with('success', 'Caixa desativado com sucesso!');
        } else {
            return redirect()->route('login.index');
        }
    }

    public function destroy($id)
    {
        //
    }
}
