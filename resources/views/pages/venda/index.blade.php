@extends('layouts.main')

@section('titulo', 'Vendas')

@section('content-center') 
    <div class="content-center">
        <div class="dashboard">
            <div class="title-content">
                <div class="title-text">
                    <span>
                        <a href="{{ route('page.dashboard') }}">
                            <i class="fas fa-home me-2"></i>Dashboard
                        </a>
                    </span>
                    <span>/</span>
                    <span>
                        <i class="fas fa-shopping-cart me-2"></i>Vendas
                    </span>
                    <span>/</span>
                    <span>Ver vendas</span>
                </div>
            </div>

            <div class="item-area">
                <div class="manage-item-top">
                    <div class="search-item">
                        <input id="search" onkeyup="search()" type="text" placeholder="Procure por uma venda">
                        <img src="{{ asset('img/search-icon.svg') }}" alt="Search">
                    </div>
                </div>

                <div class="table-item-area">
                    <table id="table-item">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Parcelas</th>
                                <th>Valor total</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>R$ </td>
                                <td></td>
                                <td>
                                    <a title="Ver venda" href="#">
                                        <img src="{{ asset('img/eye-icon.svg') }}" alt="">
                                    </a>
                                    <a title="Editar venda" href="#">
                                        <img src="{{ asset('img/pencil-icon.svg') }}" alt="">
                                    </a>
                                    <a title="Exluir venda" href="#" onclick="deleteItem('')">
                                        <img src="{{ asset('img/trash-icon.svg') }}" alt="">
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection