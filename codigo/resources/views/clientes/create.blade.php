<h1>Cadastrar Cliente</h1>
<form action="store" method="POST">
    @csrf
    <label for="nome">Nome:</label>
    <input type="text" name="nome" required>
    <br>
    <label for="debito">Debito:</label>
    <input type="text" name="debito" required>
    <br>
    <label for="endereco">Endereço:</label>
    <input type="text" name="endereco" required>
    <br>
    <label for="descricao">Descrição:</label>
    <input type="text" name="descricao" required>
    <br>
    <input type="submit" value="Cadastrar">
</form>