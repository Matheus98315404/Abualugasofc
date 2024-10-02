<?php
require_once "conexao.php";

if (!isset($_GET['id'])) {
    header("Location: listar_funcionarios.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM pagamentos WHERE id_aluguel IN (SELECT id_aluguel FROM alugueis WHERE id_funcionario = ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    if (!$stmt) {
        die('Erro na preparação da consulta: ' . mysqli_error($conexao));
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (!mysqli_stmt_execute($stmt)) {
        die('Erro na execução da consulta: ' . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_close($stmt);

    $sql = "DELETE FROM alugueis WHERE id_funcionario = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    if (!$stmt) {
        die('Erro na preparação da consulta: ' . mysqli_error($conexao));
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (!mysqli_stmt_execute($stmt)) {
        die('Erro na execução da consulta: ' . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_close($stmt);

    $sql = "DELETE FROM funcionarios WHERE id_funcionario = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    if (!$stmt) {
        die('Erro na preparação da consulta: ' . mysqli_error($conexao));
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (!mysqli_stmt_execute($stmt)) {
        die('Erro na execução da consulta: ' . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_close($stmt);

    header("Location: listar_funcionarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Funcionário</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Excluir Funcionário</h1>
        <form method="post">
            <div class="alert alert-danger">
                Tem certeza que deseja excluir este funcionário? Esta ação não pode ser desfeita e todos os registros relacionados serão excluídos.
            </div>
            <button type="submit" class="btn btn-danger">Excluir</button>
            <a href="listar_funcionarios.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
