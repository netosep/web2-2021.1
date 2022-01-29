<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use Illuminate\Http\Request;

class CaixaController extends Controller
{

    public function index()
    {
        return view('pages.caixa.index', ['caixas' => Caixa::all()->sortBy('id')]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Caixa::create($request->all());
        return redirect()->route('caixa.index')->with('success', 'Caixa criado com sucesso!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request)
    {
        return response()->json(Caixa::findOrFail($request->id_caixa));
    }

    public function update(Request $request)
    {
        Caixa::findOrFail($request->id_caixa)->update($request->all());
        return redirect()->route('caixa.index')->with('success', 'Caixa atualizado com sucesso!');
    }

    public function ativar($id)
    {
        Caixa::findOrFail($id)->update(['ativo' => true]);
        return redirect()->route('caixa.index')->with('success', 'Caixa ativado com sucesso!');
    }

    public function desativar($id)
    {
        Caixa::findOrFail($id)->update(['ativo' => false]);
        return redirect()->route('caixa.index')->with('success', 'Caixa desativado com sucesso!');
    }

    public function destroy($id)
    {
        //
    }
}
