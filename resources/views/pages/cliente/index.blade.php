@extends('layouts.main')

@section('titulo', 'Clientes')

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
                        <i class="fas fa-users me-2"></i>Clientes
                    </span>
                </div>
            </div>

            <div class="item-area">
                <div class="manage-item-top">
                    <div class="search-item">
                        <input id="search" onkeyup="search()" type="text" placeholder="Procure por um cliente">
                        <img src="{{ asset('img/search-icon.svg') }}" alt="">
                    </div>

                    <button type="button" id="btn" data-toggle="modal" data-target="#cadastrar-cliente-modal">
                        <i class="fas fa-plus me-2"></i>Cadastrar Cliente
                    </button>

                    <!-- modal cadastro de cliente -->
                    @include('pages.cliente.modal.create')

                </div>

                <div class="table-item-area">
                    <table id="table-item">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome do Cliente</th>
                                <th>Contato</th>
                                <th>CPF</th>
                                <th>Crédito</th>
                                <th>Debito</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>R$ </td>
                                    <td>R$ </td>
                                    <td>
                                        <button title="Ver cliente" onclick="">
                                            <img src="{{ asset('img/eye-icon.svg') }}" alt="">
                                        </button>
                                        <button title="Editar cliente" onclick="editCliente('')" data-toggle="modal" data-target="#editar-cliente-modal">
                                            <img src="{{ asset('img/pencil-icon.svg') }}" alt="">
                                        </button>
                                        
                                        <button title="Exluir cliente" onclick="deleteItem('')">
                                            <img src="{{ asset('img/trash-icon.svg') }}" alt="">
                                        </button>
                                    </td>
                                </tr>
                        </tbody>
                    </table>

                    <!-- modal para editar um cliente -->
                    @include('pages.cliente.modal.edit')

                </div>
            </div>
        </div>
    </div>
@endsection