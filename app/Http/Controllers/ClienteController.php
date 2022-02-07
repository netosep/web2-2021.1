<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contato;
use App\Models\Endereco;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function index()
    {
        return view('pages.cliente.index', [
            'clientes' => Cliente::with('contatos')->where('ativo', true)->orderBy('id')->get()
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $cliente = Cliente::create($request->all());
        $cliente->contatos()->create($request->all());
        $cliente->enderecos()->create($request->all());
        return redirect()->route('cliente.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request)
    {
        return response()->json(Cliente::with('contatos', 'enderecos')->findOrFail($request->id_cliente));
    }

    public function update(Request $request)
    {
        Cliente::findOrFail($request->id_cliente)->update($request->all());
        Contato::findOrFail($request->id_contato)->update($request->all());
        Endereco::findOrFail($request->id_endereco)->update($request->all());
        return redirect()->route('cliente.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Cliente::findOrFail($id)->update(['ativo' => false]);
        return redirect()->route('cliente.index')->with('success', 'Cliente excluído com sucesso!');
    }
    
}
