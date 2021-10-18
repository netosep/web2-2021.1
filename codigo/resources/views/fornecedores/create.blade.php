<h1>Cadastrar Fornecedor</h1>
<form action="store" method="POST">
    @csrf
    <label for="nome">Nome:</label>
    <input type="text" name="nome" required>
    <br>
    <label for="telefone">Telefone:</label>
    <input type="text" name="telefone" required>
    <br>
    <label for="endereco">Endereço:</label>
    <input type="text" name="endereco" required>
    <br>
    <input type="submit" value="Cadastrar">
</form>