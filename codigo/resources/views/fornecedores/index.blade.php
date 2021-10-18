<h1>Página de Fornecedores</h1>
<table border="1px">
    <tr>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Endereço</th>
    </tr>
    @foreach ($fornecedores as $fornecedor)
        <tr>
            <td>{{ $fornecedor->nome }}</td> 
            <td>{{ $fornecedor->telefone }}</td>
            <td>{{ $fornecedor->endereco }}</td>
        </tr>
    @endforeach
</table>