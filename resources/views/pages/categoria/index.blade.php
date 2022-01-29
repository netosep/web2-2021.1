@extends('layouts.main')

@section('titulo', 'Categorias')

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
                        <i class="fas fa-list-ul me-2"></i>Categorias
                    </span>
                </div>
            </div>

            <div class="item-area">
                <div class="manage-item-top">
                    <div class="search-item">
                        <input id="search" onkeyup="search()" type="text" placeholder="Procure por uma categoria">
                        <img src="{{ asset('img/search-icon.svg') }}" alt="">
                    </div>

                    <button type="button" id="btn" data-toggle="modal" data-target="#cadastrar-categoria-modal">
                        <i class="fas fa-plus me-2"></i>Adicionar Categoria
                    </button>

                    <!-- modal para cadastro de categorias -->
                    @include('pages.categoria.modal.create')

                </div>

                <div class="table-item-area">
                    <table id="table-item">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome da Categoria</th>
                                <th>Quantidade de Produtos</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categorias as $categoria)
                                <tr>
                                    <td>{{ $categoria->id }}</td>
                                    <td>{{ $categoria->nome_categoria }}</td>
                                    <td>{{ count($categoria->produtos) }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm p-1" title="Ver categoria" onclick="">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm p-1" title="Editar categoria" data-toggle="modal" data-target="#editar-categoria-modal" onclick="editItem('{{ $categoria->id }}')">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm p-1" title="Exluir categoria" onclick="confirm('Tem certeza que deseja excluir esse item?') ? $(this).find('form').submit() : ''">
                                            <form action="{{ route('categoria.delete', $categoria->id) }}" method="POST" style="display: none">@method('DELETE') @csrf</form>
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4">Nenhuma categoria cadastrada</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    @include('pages.categoria.modal.edit')

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
                url: '{{ route('categoria.edit') }}',
                type: 'POST',
                data: {
                    id_categoria: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#id-categoria').val(data.id);
                    $('#nome-categoria').val(data.nome_categoria);
                }
            });
        }
    </script>
@endpush