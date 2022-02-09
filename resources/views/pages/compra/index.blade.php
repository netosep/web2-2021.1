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
                                <th>Hora</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($compras as $compra)
                                <tr id="item-details">
                                    <td>{{ $compra->id < 10 ? '0'.$compra->id : $compra->id }}</td>
                                    <td>{{ $compra->funcionario->nome_funcionario }}</td>
                                    <td>{{ $compra->fornecedor->nome_fornecedor }}</td>
                                    <td>R$ {{ number_format($compra->valor_total, 2, ',', '') }}</td>
                                    <td>{{ date('d/m/Y', strtotime($compra->created_at)) }}</td>
                                    <td>{{ date('H:i', strtotime($compra->created_at)) }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm p-1" title="Ver compra" onclick="" disabled>
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm p-1" title="Editar compra" onclick="editItem('{{ $compra->id }}')" data-toggle="modal" data-target="#editar-compra-modal" disabled>
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm p-1" title="Exluir compra" onclick="confirm('Tem certeza que deseja excluir esse item?') ? $(this).find('form').submit() : ''">
                                            <form action="{{ route('compra.delete', $compra->id) }}" method="POST" style="display: none">@method('DELETE') @csrf</form>
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="text-center">Nenhuma compra cadastrada</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if (session('success'))
        <script>
            toastr.options = { "positionClass": "toast-bottom-right"}
            toastr.success('{{ session('success') }}')
        </script>
    @endif
@endpush