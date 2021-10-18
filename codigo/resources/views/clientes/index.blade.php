<h1>Página de clientes</h1>
<table border="1px">
    <tr>
        <th>Nome</th>
        <th>Débito</th>
        <th>Endereço</th>
    </tr>
    @foreach ($clientes as $cliente)
        <tr>
            <td>{{ $cliente->nome }}</td> 
            <td>{{ $cliente->debito }}</td>
            <td>{{ $cliente->endereco }}</td>
        </tr>
    @endforeach
</table>

