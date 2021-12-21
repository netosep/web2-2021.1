<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function index()
    {
        return view('pages.categoria.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        dd($request->all());
        //return redirect()->route('categoria.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
