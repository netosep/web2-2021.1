@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Dashboard</h4>
    </div>
    <div class="dashboard">
        <a class="btn btn-primary" href="{{ route("produtos.index") }}">
            <i class="fas fa-tags"></i>
            <p>Produtos</p>
        </a>
        <a class="btn btn-secondary" href="{{ route("clientes.index") }}">
            <i class="fas fa-users"></i>
            <p>Clientes</p>
        </a>
        <a class="btn btn-success" href="{{ route("fornecedores.index") }}">
            <i class="fas fa-truck"></i>
            <p>Fornecedores</p>
        </a>
        <a class="btn btn-danger" href="{{ route("vendas.index") }}">
            <i class="fas fa-shopping-cart"></i>
            <p>Vendas</p>
        </a>
        <a class="btn btn-warning" href="{{ route("compras.index") }}">
            <i class="fas fa-dollar-sign"></i>
            <p>Compras</p>
        </a>
    </div>
@endsection