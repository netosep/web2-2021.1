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
                            @forelse ($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->id }}</td>
                                    <td>{{ $cliente->nome_cliente }}</td>
                                    <td>{{ isset($cliente->contatos[0]) ? "(".$cliente->contatos[0]->ddd.") ".$cliente->contatos[0]->numero_telefone : "--" }}</td>
                                    <td>{{ $cliente->cpf }}</td>
                                    <td>R$ {{ number_format($cliente->credito, 2, ',', '') }}</td>
                                    <td>R$ {{ number_format($cliente->debito, 2, ',', '') }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm p-1" title="Ver cliente" onclick="">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm p-1" title="Editar cliente" onclick="editItem('{{ $cliente->id }}')" data-toggle="modal" data-target="#editar-cliente-modal">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm p-1" title="Exluir cliente" onclick="confirm('Tem certeza que deseja excluir esse item?') ? $(this).find('form').submit() : ''">
                                            <form action="{{ route('cliente.delete', $cliente->id) }}" method="POST" style="display: none">@method('DELETE') @csrf</form>
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7">Nenhum cliente cadastrado</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- modal para editar um cliente -->
                    @include('pages.cliente.modal.edit')

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
                url: '{{ route('cliente.edit') }}',
                type: 'POST',
                data: {
                    id_cliente: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#id-cliente').val(data.id);
                    $('#nome-cliente').val(data.nome_cliente);
                    $('#cpf').val(data.cpf);
                    $('#id-contato').val(data.contatos[0].id);
                    $('#ddd').val(data.contatos[0].ddd);
                    $('#telefone').val(data.contatos[0].numero_telefone);
                    $('#id-endereco').val(data.enderecos[0].id);
                    $('#rua').val(data.enderecos[0].rua);
                    $('#numero').val(data.enderecos[0].numero);
                    $('#bairro').val(data.enderecos[0].bairro);
                    $('#cidade').val(data.enderecos[0].cidade);
                    $('#estado').val(data.enderecos[0].estado);
                }
            });
        }
    </script>
@endpush