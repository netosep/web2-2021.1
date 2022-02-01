<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use App\Validate\LoginValidate;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    public function index()
    {
        if (LoginValidate::hasSession()) {
            return redirect()->route('page.dashboard');
        } else {
            return view('pages.usuario.login');
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = trim($request->usuario);
        $pass = trim($request->senha);
        $funcionario = Funcionario::where('usuario', $user)->first();

        if ($funcionario && Hash::check($pass, $funcionario->senha)) {
            $userSession = Funcionario::with('caixa')->find($funcionario->id);
            session()->put('user', $userSession);
            return redirect()->route('page.dashboard');
        } else {
            session()->flash('error', 'Usuário ou senha inválidos!');
            return redirect()->route('login.index');
        }

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

    public function logout()
    {
        if (LoginValidate::hasSession()) {
            session()->forget('user');
            return redirect()->route('login.index');
        } else {
            return redirect()->route('login.index');
        }
    }
}
