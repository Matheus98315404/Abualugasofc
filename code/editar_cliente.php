<?php
require_once "conexao.php";

if (!isset($_GET['id'])) {
    header("Location: listar_clientes.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cpf_cnpj = $_POST['cpf_cnpj'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $carteira_motorista = $_POST['carteira_motorista'];
    $validade_carteira = $_POST['validade_carteira'];

    $sql = "UPDATE clientes SET nome = ?, cpf_cnpj = ?, endereco = ?, telefone = ?, email = ?, carteira_motorista = ?, validade_carteira = ? WHERE id_cliente = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssi", $nome, $cpf_cnpj, $endereco, $telefone, $email, $carteira_motorista, $validade_carteira, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: listar_clientes.php");
    exit();
}

$sql = "SELECT * FROM clientes WHERE id_cliente = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id_cliente, $nome, $cpf_cnpj, $endereco, $telefone, $email, $carteira_motorista, $validade_carteira);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Cliente</h1>
        <form method="post">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?php echo htmlspecialchars($nome); ?>" required>
            </div>
            <div class="form-group">
                <label for="cpf_cnpj">CPF/CNPJ:</label>
                <input type="text" id="cpf_cnpj" name="cpf_cnpj" class="form-control" value="<?php echo htmlspecialchars($cpf_cnpj); ?>" required>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" class="form-control" value="<?php echo htmlspecialchars($endereco); ?>">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" class="form-control" value="<?php echo htmlspecialchars($telefone); ?>">
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>">
            </div>
            <div class="form-group">
                <label for="carteira_motorista">Carteira de Motorista:</label>
                <input type="text" id="carteira_motorista" name="carteira_motorista" class="form-control" value="<?php echo htmlspecialchars($carteira_motorista); ?>" required>
            </div>
            <div class="form-group">
                <label for="validade_carteira">Validade da Carteira:</label>
                <input type="date" id="validade_carteira" name="validade_carteira" class="form-control" value="<?php echo htmlspecialchars($validade_carteira); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="listar_clientes.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
