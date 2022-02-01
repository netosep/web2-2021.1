<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use App\Models\Funcionario;
use App\Validate\LoginValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FuncionarioController extends Controller
{

    public function index()
    {
        if (LoginValidate::hasSession()) {
            return view('pages.funcionario.index', [
                'funcionarios' => Funcionario::with('caixa')->where('ativo', true)->orderBy('id')->get(),
                'caixas' => Caixa::where('ativo', true)->where('id', '>', 1)->orderBy('id')->get()
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
            if (Funcionario::where('usuario', trim($request->usuario))->first() != null) {
                return redirect()->back()->with('error', 'O usuário já está sendo usado!');
            } else if (Funcionario::where('email', trim($request->email))->first()) {
                return redirect()->back()->with('error', 'O email já está sendo usado!');
            } else {
                Funcionario::create([
                    'nome_funcionario' => $request->nome_funcionario,
                    'cpf' => $request->cpf,
                    'telefone' => $request->telefone,
                    'email' => trim($request->email),
                    'usuario' => trim($request->usuario),
                    'senha' => Hash::make(trim($request->senha)),
                    'nivel_acesso' => $request->nivel_acesso,
                    'caixa_id' => $request->caixa_id,
                    'endereco_completo' => $request->endereco_completo,
                    'cargo' => $request->cargo,
                    'salario' => $request->salario
                ]);
                return redirect()->back()->with('success', 'Funcionário cadastrado com sucesso!');
            }
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
            return response()->json(Funcionario::findOrFail($request->id_funcionario));
        } else {
            return redirect()->route('login.index');
        }
    }

    public function update(Request $request)
    {
        if (LoginValidate::hasSession()) {
            Funcionario::findOrFail($request->id_funcionario)->update($request->all());
            return redirect()->route('funcionario.index')->with('success', 'Funcionario atualizado com sucesso!');
        } else {
            return redirect()->route('login.index');
        }
    }

    public function destroy($id)
    {
        if (LoginValidate::hasSession()) {
            Funcionario::findOrFail($id)->update(['ativo' => false]);
            return redirect()->route('funcionario.index')->with('success', 'Funcionario excluido com sucesso!');
        } else {
            return redirect()->route('login.index');
        }
    }
}
