@extends('layouts.main')

@section('titulo', 'Produtos')

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
                        <i class="fas fa-box-open me-2"></i>Produtos
                    </span>
                </div>
            </div>

            <div class="item-area">
                <div class="manage-item-top">
                    <div class="search-item">
                        <input id="search" onkeyup="search()" type="text" placeholder="Procure por um produto">
                        <img src="{{ asset('img/search-icon.svg') }}" alt="Procurar">
                    </div>

                    <button type="button" id="btn" data-toggle="modal" data-target="#cadastrar-produto-modal">
                        <i class="fas fa-plus me-2"></i>Cadastrar Produto
                    </button>
                    <!-- modal para cadastro do produto -->
                    @include('pages.produto.modal.create')

                </div>

                <div class="table-item-area">
                    <table id="table-item">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome do Produto</th>
                                <th>Categoria</th>
                                <th>Preço de Compra</th>
                                <th>Preço de Venda</th>
                                <th>Quantidade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produtos as $produto)
                                <tr id="item-details">
                                    <td>{{ $produto->id < 10 ? '0'.$produto->id : $produto->id }}</td>
                                    <td>{{ $produto->nome_produto }}</td>
                                    <td>{{ $produto->categoria->nome_categoria }}</td>
                                    <td>R$ {{ number_format($produto->valor_compra, 2, ',', '') }}</td>
                                    <td>R$ {{ number_format($produto->valor_venda, 2, ',', '') }}</td>
                                    <td>{{ $produto->quantidade }} unid.</td>
                                    <td>
                                        <button class="btn btn-success btn-sm p-1" title="Ver produto" onclick="">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm p-1" title="Editar produto" onclick="editItem('{{ $produto->id }}')" data-toggle="modal" data-target="#editar-produto-modal">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm p-1" title="Exluir produto" onclick="confirm('Tem certeza que deseja excluir esse item?') ? $(this).find('form').submit() : ''">
                                            <form action="{{ route('produto.delete', $produto->id) }}" method="POST" style="display: none">@method('DELETE') @csrf</form>
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7">Nenhum produto cadastrado</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- modal para editar um produto -->
                    @include('pages.produto.modal.edit')
                
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
                url: '{{ route('produto.edit') }}',
                type: 'POST',
                data: {
                    id_produto: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#id-produto').val(data.id);
                    $('#nome-produto').val(data.nome_produto);
                    $('#categoria-id').val(data.categoria_id);
                }
            });
        }
    </script>
@endpush
