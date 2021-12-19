@extends('layouts.main')

@section('titulo', 'Compras')

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
                        <i class="fas fa-shopping-basket me-2"></i>Compras
                    </span>
                </div>
            </div>

            <div class="item-area">
                <div class="manage-item-top">
                    <div class="search-item">
                        <input id="search" onkeyup="search()" type="text" placeholder="Procure por uma compra">
                        <img src="{{ asset('img/search-icon.svg') }}" alt="Search">
                    </div>
                </div>

                <div class="table-item-area">
                    <table id="table-item">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Comprado por</th>
                                <th>Fornecedor</th>
                                <th>Valor total</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="item-details">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a title="Ver compra" href="#">
                                        <img src="{{ asset('img/eye-icon.svg') }}" alt="">
                                    </a>
                                    <a title="Editar compra" href="#">
                                        <img src="{{ asset('img/pencil-icon.svg') }}" alt="">
                                    </a>
                                    <a title="Exluir compra" href="#">
                                        <img src="{{ asset('img/trash-icon.svg') }}" alt="">
                                    </a>
                                    {{-- <a href="#">TESTE</a> --}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection