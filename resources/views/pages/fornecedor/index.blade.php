
@extends('layouts.main')

@section('titulo', 'Fornecedores')

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
                        <i class="fas fa-truck me-2"></i>Fornecedores
                    </span>
                </div>
            </div>

            <div class="item-area">
                <div class="manage-item-top">
                    <div class="search-item">
                        <input id="search" onkeyup="search()" type="text" placeholder="Procure por um fornecedor">
                        <img src="{{ asset('img/search-icon.svg') }}" alt="Search">
                    </div>

                    <button type="button" id="btn" data-toggle="modal" data-target="#cadastrar-fornecedor-modal">
                        <i class="fas fa-plus me-2"></i>Cadastrar Fornecedor
                    </button>

                    <!-- modal para cadastro do fornecedor -->
                    @include('pages.fornecedor.modal.create')

                </div>

                <div class="table-item-area">
                    <table id="table-item">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome do Fornecedor</th>
                                <th>Telefone</th>
                                <th>Cidade</th>
                                <th>Estado</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fornecedores as $fornecedor)
                                <tr>
                                    <td>{{ $fornecedor->id }}</td>
                                    <td>{{ $fornecedor->nome_fornecedor }}</td>
                                    <td>{{ $fornecedor->telefone }}</td>
                                    <td>{{ $fornecedor->cidade }}</td>
                                    <td>{{ $fornecedor->estado }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm p-1" title="Ver fornecedor" onclick="">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm p-1" title="Editar fornecedor" data-toggle="modal" data-target="#editar-fornecedor-modal" onclick="editItem('{{ $fornecedor->id }}')">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm p-1" title="Exluir fornecedor" onclick="confirm('Tem certeza que deseja excluir esse item?') ? $(this).find('form').submit() : ''">
                                            <form action="{{ route('fornecedor.delete', $fornecedor->id) }}" method="POST" style="display: none">@method('DELETE') @csrf</form>
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6">Nenhum fornecedor cadastrado</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- modal para editar um fornecedor -->
                    @include('pages.fornecedor.modal.edit')

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
                url: '{{ route('fornecedor.edit') }}',
                type: 'POST',
                data: {
                    id_fornecedor: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#id-fornecedor').val(data.id);
                    $('#nome-fornecedor').val(data.nome_fornecedor);
                    $('#telefone').val(data.telefone);
                    $('#cidade').val(data.cidade);
                    $('#estado').val(data.estado);
                }
            })
        }
    </script>
@endpush

