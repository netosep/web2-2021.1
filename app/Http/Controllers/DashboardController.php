<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Validate\LoginValidate;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        if (LoginValidate::hasSession()) {
            return view('pages.dashboard.index', [
                'quantidade_clientes' => Cliente::all()->count()
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
