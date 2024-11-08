<?php
require_once 'conexao.php';

/**
 * Função para cadastrar um novo funcionário no banco de dados.
 *
 * @param string    $nome      Nome completo do funcionário.
 * @param string    $cpf       CPF do funcionário.
 * @param string    $telefone  Número de telefone do funcionário.
 * @param string    $email     Endereço de e-mail do funcionário.
 * @return void
 */

 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário via POST
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    // Comando SQL para inserir os dados do funcionário na tabela "funcionarios"
    $sql = "INSERT INTO funcionarios (nome, cpf, telefone, email) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt) {
        // Vincula os parâmetros à consulta SQL
        mysqli_stmt_bind_param($stmt, 'ssss', $nome, $cpf, $telefone, $email);

        // Executa a consulta preparada
        if (mysqli_stmt_execute($stmt)) {
            // Se a execução for bem-sucedida, redireciona o usuário para a página de confirmação
            header("Location: cadastrocerto.html");
            exit();
        } else {
            // Se ocorrer erro ao executar a consulta, exibe o erro
            echo "Erro ao executar a consulta: " . mysqli_stmt_error($stmt);
        }

        // Fecha a declaração preparada
        mysqli_stmt_close($stmt);
    } else {
        // Se ocorrer erro na preparação da consulta, exibe o erro
        echo "Erro na preparação da consulta: " . mysqli_error($conexao);
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
}
?>
