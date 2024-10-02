<?php
require_once "conexao.php";

if (!isset($_GET['id'])) {
    header("Location: listar_clientes.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "UPDATE alugueis SET id_cliente = NULL WHERE id_cliente = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql = "DELETE FROM clientes WHERE id_cliente = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: listar_clientes.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Cliente</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Excluir Cliente</h1>
        <form method="post">
            <div class="alert alert-danger">
                Tem certeza que deseja excluir este cliente? Esta ação não pode ser desfeita. Todos os registros relacionados terão a referência removida.
            </div>
            <button type="submit" class="btn btn-danger">Excluir</button>
            <a href="listar_clientes.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
