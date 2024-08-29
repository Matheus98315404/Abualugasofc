<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtendo dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    // Preparando a consulta SQL
    $sql = "INSERT INTO funcionarios (nome, cpf, telefone, email) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt) {
        // Vinculando os parâmetros
        mysqli_stmt_bind_param($stmt, 'ssss', $nome, $cpf, $telefone, $email);
        
        // Executando a consulta
        if (mysqli_stmt_execute($stmt)) {
            // Redireciona para a página de sucesso
            header("Location: cadastrocerto.html");
            exit();
        } else {
            echo "Erro ao executar a consulta: " . mysqli_stmt_error($stmt);
        }

        // Fechando o statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro na preparação da consulta: " . mysqli_error($conexao);
    }

    // Fechando a conexão
    mysqli_close($conexao);
}
?>
