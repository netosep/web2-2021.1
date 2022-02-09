<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $totalVendaDia = DB::select('SELECT * FROM vendaDoDia(?)', [date('Y-m-d')]);
        $produtosAbaixoEstoque = DB::select('SELECT * FROM produtosAbaixoEstoque(?)', [10]);
        $clientesParcelaVencendo = DB::select('SELECT * FROM clienteParcelaVencendo(?)', [date('Y-m-d')]);

        return view('pages.dashboard.index', [
            'totalVendaDia' => $totalVendaDia[0]->total_venda_dia,
            'produtosAbaixoEstoque' => $produtosAbaixoEstoque,
            'clientesParcelaVencendo' => $clientesParcelaVencendo,
            'quantidade_clientes' => Cliente::all()->count(),
            'totalVendasDia' => Venda::whereDate('created_at', date('Y-m-d'))->count()
        ]);
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
