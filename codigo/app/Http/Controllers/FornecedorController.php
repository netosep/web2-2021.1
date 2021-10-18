<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index() {
        return view('fornecedores.index', ['fornecedores' => Fornecedor::all()]);
    }

    public function create() {
        return view('fornecedores.create');
    }

    public function store(Request $request) {
        $fornecedor = new Fornecedor();
        $fornecedor->nome = $request->nome;
        $fornecedor->telefone = $request->telefone;
        $fornecedor->endereco = $request->endereco;
        $fornecedor->save();

        return redirect('/fornecedor/index');
    }
}
