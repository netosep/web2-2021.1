<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contato;
use App\Models\Endereco;
use App\Validate\LoginValidate;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function index()
    {
        if (LoginValidate::hasSession()) {
            return view('pages.cliente.index', [
                'clientes' => Cliente::with('contatos')->where('ativo', true)->orderBy('id')->get()
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
            $cliente = Cliente::create($request->all());
            $cliente->contatos()->create($request->all());
            $cliente->enderecos()->create($request->all());
            return redirect()->route('cliente.index')->with('success', 'Cliente cadastrado com sucesso!');
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
            return response()->json(Cliente::with('contatos', 'enderecos')->findOrFail($request->id_cliente));
        } else {
            return redirect()->route('login.index');
        }
    }

    public function update(Request $request)
    {
        if (LoginValidate::hasSession()) {
            Cliente::findOrFail($request->id_cliente)->update($request->all());
            Contato::findOrFail($request->id_contato)->update($request->all());
            Endereco::findOrFail($request->id_endereco)->update($request->all());
            return redirect()->route('cliente.index')->with('success', 'Cliente atualizado com sucesso!');
        } else {
            return redirect()->route('login.index');
        }
    }

    public function destroy($id)
    {
        if (LoginValidate::hasSession()) {
            Cliente::findOrFail($id)->update(['ativo' => false]);
            return redirect()->route('cliente.index')->with('success', 'Cliente excluído com sucesso!');
        } else {
            return redirect()->route('login.index');
        }
    }
    
}
