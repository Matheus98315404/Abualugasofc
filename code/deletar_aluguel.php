<?php
require_once 'conexao.php'; // Conexão com o banco de dados

$status_message = ""; // Mensagem de status

if (isset($_POST['id_aluguel'])) {
    $id_aluguel = $_POST['id_aluguel'];

    // Preparar e executar a consulta para excluir os registros relacionados em pagamentos
    $sql_delete_pagamentos = "DELETE FROM pagamentos WHERE id_aluguel = ?";
    $stmt_pagamentos = $conexao->prepare($sql_delete_pagamentos);
    $stmt_pagamentos->bind_param("i", $id_aluguel);

    if ($stmt_pagamentos->execute()) {
        // Se a exclusão de pagamentos foi bem-sucedida, excluir os registros relacionados em alugueis_veiculos
        $sql_delete_veiculos = "DELETE FROM alugueis_veiculos WHERE alugueis_id_aluguel = ?";
        $stmt_veiculos = $conexao->prepare($sql_delete_veiculos);
        $stmt_veiculos->bind_param("i", $id_aluguel);

        if ($stmt_veiculos->execute()) {
            // Se a exclusão de alugueis_veiculos foi bem-sucedida, excluir o aluguel
            $sql_delete_aluguel = "DELETE FROM alugueis WHERE id_aluguel = ?";
            $stmt_aluguel = $conexao->prepare($sql_delete_aluguel);
            $stmt_aluguel->bind_param("i", $id_aluguel);

            if ($stmt_aluguel->execute()) {
                $status_message = "Veículo disponível para aluguel novamente!";
            } else {
                $status_message = "Erro ao tentar tornar o veículo disponível: " . $stmt_aluguel->error;
            }

            // Fechar a consulta do aluguel
            $stmt_aluguel->close();
        } else {
            $status_message = "Erro ao tentar tornar o veículo disponível: " . $stmt_veiculos->error;
        }

        // Fechar a consulta dos veículos
        $stmt_veiculos->close();
    } else {
        $status_message = "Erro ao excluir os registros de pagamentos: " . $stmt_pagamentos->error;
    }

    // Fechar a consulta dos pagamentos
    $stmt_pagamentos->close();

    // Fechar a conexão
    $conexao->close();
} else {
    $status_message = "ID do aluguel não fornecido.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Exclusão</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #007BFF;
        }
        .status-message {
            text-align: center;
            margin: 20px 0;
            font-size: 1.2em;
        }
        .button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            font-size: 1em;
            cursor: pointer;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Disponibilidade alterada</h1>
        <div class="status-message"><?php echo $status_message; ?></div>
        <a href="index.html" class="button">Voltar para o Início</a>
    </div>
</body>
</html>
