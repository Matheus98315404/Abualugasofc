<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    $sql = "INSERT INTO funcionarios (nome, cpf, telefone, email)
            VALUES ('$nome', '$cpf', '$telefone', '$email')";}

mysqli_query($conexao, $sql);

    header("Location: cadastrocerto.html")
?>