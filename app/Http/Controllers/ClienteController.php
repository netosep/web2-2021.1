<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index() {
        return view('clientes.index', ['clientes' => Cliente::all()->sortBy('id')]);
    }

    public function create() {
        return view('clientes.create');
    }

    public function store(StoreClienteRequest $request) {
        Cliente::create($request->all());
        return redirect()->route('clientes.index');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', ['cliente' => $cliente]);
    }

    public function update(StoreClienteRequest $request, $id) {
        Cliente::findOrFail($id)->update($request->all());
        return redirect()->route('clientes.index');
    }

    public function destroy($id) {
        Cliente::findOrFail($id)->delete();
        return redirect()->route('clientes.index');
    }
}
