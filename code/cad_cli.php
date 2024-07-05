<?php

require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome =  $_POST['nome'];
    $cpf_cnpj = $_POST['cpf_cnpj'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $carteira_motorista = $_POST['carteira_motorista'];
    $validade_carteira = $_POST['validade_carteira'];

    $sql = "INSERT INTO clientes (nome, cpf_cnpj, endereco, telefone, email, carteira_motorista, validade_carteira)
    VALUES ('$nome', '$cpf_cnpj', '$endereco', '$telefone', '$email', '$carteira_motorista', '$validade_carteira')";
}

mysqli_query($conexao, $sql);

    header("Location: cadastrocerto.html")
?>