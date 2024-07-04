<?php

require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

   
    $sql = "INSERT INTO funcionario (nome, cpf, telefone, email) VALUES ('$nome', '$cpf', '$telefone', '$email')"; 

    if (mysqli_query($conexao, $sql)) {
        
        header("Location: funcionario.html");
        exit(); 
        
    } else {
       
        echo "Erro: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
}
?>
