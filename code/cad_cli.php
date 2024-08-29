<?php

require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cpf_cnpj = $_POST['cpf_cnpj'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $carteira_motorista = $_POST['carteira_motorista'];
    $validade_carteira = $_POST['validade_carteira'];

    $sql = "INSERT INTO clientes (nome, cpf_cnpj, endereco, telefone, email, carteira_motorista, validade_carteira) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conexao, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssss", $nome, $cpf_cnpj, $endereco, $telefone, $email, $carteira_motorista, $validade_carteira);
        
        mysqli_stmt_execute($stmt);
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro na preparação da consulta: " . mysqli_error($conexao);
    }

    header("Location: cadastrocerto.html");
    exit(); 
}

?>
