<?php

namespace App\Http\Controllers;
use App\Validate\LoginValidate;
use Illuminate\Http\Request;

class CompraController extends Controller
{

    public function index()
    {
        if (LoginValidate::hasSession()) {
            return view('pages.compra.index');
        } else {
            return redirect()->route('login.index');
        }
    }

    public function create()
    {
        return view('pages.compra.create');
    }

    public function store(Request $request)
    {
        //
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
