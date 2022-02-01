@extends('layouts.main')

@section('titulo', 'Funcionários')
    
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
                        <i class="fas fa-user-tie me-2"></i>Funcionários
                    </span>
                </div>
            </div>

            <div class="item-area">
                <div class="manage-item-top">
                    <div class="search-item">
                        <input id="search" onkeyup="search()" type="text" placeholder="Procure por um funcionário">
                        <img src="{{ asset('img/search-icon.svg') }}" alt="Search">
                    </div>

                    <button type="button" id="btn" data-toggle="modal" data-target="#cadastrar-funcionario-modal">
                        <i class="fas fa-plus me-2"></i>Cadastrar Funcionário
                    </button>

                    <!-- modal para cadastro do funcionario -->
                    @include('pages.funcionario.modal.create')

                </div>

                <div class="table-item-area">
                    <table id="table-item">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome do Funcionário</th>
                                <th>Telefone</th>
                                <th>Cargo</th>
                                <th>Nivel de Acesso</th>
                                <th>Salario</th>
                                <th>Caixa</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($funcionarios as $funcionario)
                                <tr>
                                    <td>{{ $funcionario->id < 10 ? '0'.$funcionario->id : $funcionario->id }}</td>
                                    <td>{{ $funcionario->nome_funcionario }}</td>
                                    <td>{{ $funcionario->telefone }}</td>
                                    <td>{{ $funcionario->cargo }}</td>
                                    <td>
                                        @if ($funcionario->nivel_acesso == 0) 
                                            --
                                        @elseif ($funcionario->nivel_acesso == 1) 
                                            ADMIN
                                        @else 
                                            CAIXA
                                        @endif
                                    </td>
                                    <td>R$ {{ number_format($funcionario->salario, 2, ',', '') }}</td>
                                    <td>
                                        {{ $funcionario->caixa != null ? $funcionario->caixa->identificador : '--' }}
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-sm p-1" title="Ver funcionario" onclick="">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @if ($funcionario->id == 1)
                                            <button class="btn btn-primary btn-sm p-1" title="Não disponível" disabled>
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm p-1" title="Não disponível" disabled>
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @else
                                            <button class="btn btn-primary btn-sm p-1" title="Editar funcionario" onclick="editItem('{{ $funcionario->id }}')" data-toggle="modal" data-target="#editar-funcionario-modal">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm p-1" title="Exluir funcionario" onclick="confirm('Tem certeza que deseja excluir esse item?') ? $(this).find('form').submit() : ''">
                                                <form action="{{ route('funcionario.delete', $funcionario->id) }}" method="POST" style="display: none">@method('DELETE') @csrf</form>
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr> 
                            @empty
                                <tr><td colspan="8">Nenhum funcionário cadastrado</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- modal para editar um funcionario -->
                    @include('pages.funcionario.modal.edit')
                    
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
    @if (session('error'))
        <script>
            toastr.options = { "positionClass": "toast-bottom-right"}
            toastr.error('{{ session('error') }}')
        </script>
    @endif
    <script>
        function ativarInputs(checkbox) {
            if ($(checkbox).is(':checked')) {
                $('#usuario').attr('disabled', false).css('background-color', '#f6f6f6');
                $('#nivel-acesso').attr('disabled', false).css('background-color', '#f6f6f6');
                $('#caixa-cadastro').attr('disabled', false).css('background-color', '#f6f6f6');
                $('#senha').attr('disabled', false).css('background-color', '#f6f6f6');
                $('#confirma-senha').attr('disabled', false).css('background-color', '#f6f6f6');
            } else {
                $('#usuario').attr('disabled', true).css('background-color', '#e5e5e5');
                $('#nivel-acesso').attr('disabled', true).css('background-color', '#e5e5e5');
                $('#caixa-cadastro').attr('disabled', true).css('background-color', '#e5e5e5');
                $('#senha').attr('disabled', true).css('background-color', '#e5e5e5');
                $('#confirma-senha').attr('disabled', true).css('background-color', '#e5e5e5');
            }
        }

        function editItem(id) {
            $.ajax({
                url: '{{ route('funcionario.edit') }}',
                type: 'POST',
                data: {
                    id_funcionario: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#id-funcionario').val(data.id);
                    $('#nome-funcionario').val(data.nome_funcionario);
                    $('#cpf').val(data.cpf);
                    $('#telefone').val(data.telefone);
                    $('#email').val(data.email);
                    $('#endereco').val(data.endereco_completo);
                    $('#cargo').val(data.cargo);
                    $('#salario').val(data.salario);
                }
            });
        }
    </script>
@endpush

{{-- <script>

    var funcionarios = [];

    function editFuncionario(idFuncionario) {

        var editFuncionarioModal = document.getElementById("editar-funcionario-modal");
        var funcionarioEdit;

        funcionarios.forEach(funcionario => {
            if(funcionario.id == idFuncionario) {
                funcionarioEdit = funcionario;
            }
        });

        var inputEdit = {
            id: editFuncionarioModal.querySelector("#id-funcionario"),
            nome: editFuncionarioModal.querySelector("#nome"),
            cpf: editFuncionarioModal.querySelector("#cpf"),
            telefone: editFuncionarioModal.querySelector("#telefone"),
            email: editFuncionarioModal.querySelector("#email"),
            endereco: editFuncionarioModal.querySelector("#endereco"),
            caixa: editFuncionarioModal.querySelector("#caixa"),
            cargo: editFuncionarioModal.querySelector("#cargo"),
            salario: editFuncionarioModal.querySelector("#salario"),
            acesso: editFuncionarioModal.querySelector("#acesso")
        }

        inputEdit.id.value = funcionarioEdit.id;
        inputEdit.nome.value = funcionarioEdit.nome;
        inputEdit.cpf.value = funcionarioEdit.cpf;
        inputEdit.telefone.value = funcionarioEdit.telefone;
        inputEdit.email.value = funcionarioEdit.email;
        inputEdit.endereco.value = funcionarioEdit.endereco;
        inputEdit.cargo.value = funcionarioEdit.cargo;
        inputEdit.salario.value = funcionarioEdit.salario;

        var divAcessoCaixa = document.getElementById("input-acesso-caixa");
        var inputAcesso = document.getElementById("acesso");
        var inputCaixa = document.getElementById("caixa");

        if(parseInt(funcionarioEdit.acesso) < 3) {
            inputAcesso.disabled = false;
            inputCaixa.disabled = false;
            divAcessoCaixa.style.display = "block";
            inputEdit.acesso.value = funcionarioEdit.acesso;
            inputEdit.caixa.value = funcionarioEdit.caixa;
        } else {
            inputAcesso.disabled = true;
            inputCaixa.disabled = true;
            divAcessoCaixa.style.display = "none";
        }
        
    }

</script> --}}
