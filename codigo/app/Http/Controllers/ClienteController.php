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
        $cliente->debito = $request->debito;
        $cliente->endereco = $request->endereco;
        $cliente->descricao = $request->descricao;
        $cliente->save();

        return redirect('/cliente/index');
    }
}
