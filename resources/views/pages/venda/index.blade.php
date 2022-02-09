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
                                <th>Hora</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vendas as $venda)
                                <tr>
                                    <td>{{ $venda->id < 10 ? '0'.$venda->id : $venda->id }}</td>
                                    <td>{{ $venda->cliente->nome_cliente }}</td>
                                    <td style="text-transform: lowercase !important">
                                        {{ $venda->pagamentovenda->parcelas.'x'}}
                                    </td>
                                    <td>R$ {{ number_format($venda->valor_total, 2, ',', '') }}</td>
                                    <td>{{ date('d/m/Y', strtotime($venda->created_at)) }}</td>
                                    <td>{{ date('H:i', strtotime($venda->created_at)) }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm p-1" title="Ver venda" onclick="" disabled>
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm p-1" title="Editar venda" onclick="editItem('{{ $venda->id }}')" data-toggle="modal" data-target="#editar-venda-modal">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm p-1" title="Exluir venda" onclick="confirm('Tem certeza que deseja excluir esse item?') ? $(this).find('form').submit() : ''">
                                            <form action="{{ route('venda.delete', $venda->id) }}" method="POST" style="display: none">@method('DELETE') @csrf</form>
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7">Nenhuma venda cadastrada</td></tr>
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