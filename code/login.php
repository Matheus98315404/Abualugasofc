<?php

session_start();
if (!isset($_SESSION['funcionario_autenticado'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Bem-vindo ao painel de controle</h2>
    <p>Esta página é protegida e só pode ser acessada por funcionários autenticados.</p>
    <a href="logout.php">Sair</a>
</body>
</html>
