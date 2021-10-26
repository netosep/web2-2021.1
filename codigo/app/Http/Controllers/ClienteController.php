<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index() {
        return view('clientes.index', ['clientes' => Cliente::all()]);
    }

    public function create() {
        return view('clientes.create');
    }

    public function store(Request $request) {

        $cliente = new Cliente();
        $cliente->nome = $request->nome;
        $cliente->endereco = $request->endereco;
        $cliente->descricao = $request->descricao;
        $cliente->save();

        return redirect('/clientes/index');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $cliente = Cliente::find($id);
        return view('clientes.edit', ['cliente' => $cliente]);
    }

    public function update(Request $request, $id) {
        Cliente::find($id)->update($request->all());
        return redirect('/clientes/index');
    }

    public function destroy($id) {
        Cliente::find($id)->delete();
        return redirect('/clientes/index');
    }
}
