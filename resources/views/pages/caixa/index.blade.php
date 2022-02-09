@extends('layouts.main')

@section('titulo', 'Caixas')

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
                        <i class="fas fa-money-bill-wave me-2"></i>Finanças
                    </span>
                    <span>/</span>
                    <span>
                        <i class="fas fa-cash-register me-2"></i>Caixas
                    </span>
                </div>
            </div>

            <div class="item-area">
                <div class="manage-item-top">
                    <div class="search-item">
                        <input id="search" onkeyup="search()" type="text" placeholder="Procure por um caixa">
                        <img src="{{ asset('img/search-icon.svg') }}" alt="Procurar">
                    </div>

                    <button type="button" id="btn" data-toggle="modal" data-target="#cadastrar-caixa-modal">
                        <i class="fas fa-plus me-2"></i>Adicionar Caixa
                    </button>

                    <!-- modal para cadastro de caixas -->
                    @include('pages.caixa.modal.create')

                </div>

                <div class="table-item-area">
                    <table id="table-item">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Identificador do caixa</th>
                                <th>Valor em caixa</th>
                                <th>Status</th>
                                <th>Operação</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($caixas as $caixa)
                                <tr>
                                    <td>{{ $caixa->id < 10 ? '0'.$caixa->id : $caixa->id }}</td>
                                    <td>{{ $caixa->identificador }}</td>
                                    <td>R$ {{ number_format($caixa->valor_em_caixa, 2, ',', '') }}</td>
                                    <td>{{ $caixa->status == 'A' ? 'Aberto' : 'Fechado' }}</td>
                                    <td>{{ $caixa->ativo ? 'Ativo' : 'Desativado' }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm p-1" title="Ver caixa" disabled>
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @if ($caixa->id == 1)
                                            <button class="btn btn-primary btn-sm p-1" disabled>
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            @if ($caixa->ativo)
                                                <button class="btn btn-danger btn-sm p-1" disabled>
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-secondary btn-sm p-1" disabled>
                                                    <i class="fas fa-play"></i>
                                                </button>
                                            @endif
                                        @else
                                            <button class="btn btn-primary btn-sm p-1" title="Editar caixa" onclick="editItem('{{ $caixa->id }}')" data-toggle="modal" data-target="#editar-caixa-modal">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            @if ($caixa->ativo)
                                                <button class="btn btn-danger btn-sm p-1" title="Desativar caixa" onclick="confirm('Tem certeza que deseja desativar esse caixa?') ? $(this).find('form').submit() : ''">
                                                    <form action="{{ route('caixa.desativar', $caixa->id) }}" method="POST" style="display: none">@method('PUT') @csrf</form>
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-secondary btn-sm p-1" title="Ativar caixa" onclick="confirm('Ativar esse caixa?') ? $(this).find('form').submit() : ''">
                                                    <form action="{{ route('caixa.ativar', $caixa->id) }}" method="POST" style="display: none">@method('PUT') @csrf</form>
                                                    <i class="fas fa-play"></i>
                                                </button>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6">Nenhum caixa cadastrado</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- modal para editar um caixa -->
                    @include('pages.caixa.modal.edit')

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
    <script>
        function editItem(id) {
            $.ajax({
                url: '{{ route('caixa.edit') }}',
                type: 'POST',
                data: {
                    id_caixa: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#id-caixa').val(data.id);
                    $('#identificador').val(data.identificador);
                }
            });
        }
    </script>
@endpush