<?php
require_once 'conexao.php';

// Função para executar consultas preparadas e retornar resultados
function executeQuery($conexao, $query) {
    $stmt = mysqli_prepare($conexao, $query);
    if (!$stmt) {
        echo "Erro na preparação da consulta: " . mysqli_error($conexao);
        return false;
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (!$result) {
        echo "Erro na execução da consulta: " . mysqli_error($conexao);
        return false;
    }

    mysqli_stmt_close($stmt);
    return $result;
}

// Consultas para obter os dados de funcionários, clientes e veículos
$query_funcionarios = "SELECT id_funcionario, nome FROM funcionarios";
$result_funcionarios = executeQuery($conexao, $query_funcionarios);

$query_clientes = "SELECT id_cliente, nome FROM clientes";
$result_clientes = executeQuery($conexao, $query_clientes);

$query_veiculos = "SELECT id_veiculo, placa FROM veiculos WHERE disponivel = 1";
$result_veiculos = executeQuery($conexao, $query_veiculos);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Aluguel</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <h2>Realizar Aluguel</h2>
    <form action="cad_aluguel.php" method="POST">

        <!-- Funcionário -->
        <label for="funcionario">Funcionário:</label>
        <select id="funcionario" name="id_funcionario" required>
            <option value="">Selecione um Funcionário</option>
            <?php
            if ($result_funcionarios) {
                while ($row = mysqli_fetch_assoc($result_funcionarios)) {
                    $id_funcionario = htmlspecialchars($row['id_funcionario']);
                    $nome_funcionario = htmlspecialchars($row['nome']);
                    echo "<option value='$id_funcionario'>$nome_funcionario</option>";
                }
            }
            ?>
        </select><br><br>

        <!-- Cliente -->
        <label for="cliente">Cliente:</label>
        <select id="cliente" name="id_cliente" required>
            <option value="">Selecione um Cliente</option>
            <?php
            if ($result_clientes) {
                while ($row = mysqli_fetch_assoc($result_clientes)) {
                    $id_cliente = htmlspecialchars($row['id_cliente']);
                    $nome_cliente = htmlspecialchars($row['nome']);
                    echo "<option value='$id_cliente'>$nome_cliente</option>";
                }
            }
            ?>
        </select><br><br>

        <!-- Veículo -->
        <label for="veiculo">Placa do Veículo:</label>
        <select id="veiculo" name="id_veiculo" required>
            <option value="">Selecione um Veículo</option>
            <?php
            if ($result_veiculos) {
                while ($row = mysqli_fetch_assoc($result_veiculos)) {
                    $id_veiculo = htmlspecialchars($row['id_veiculo']);
                    $placa_veiculo = htmlspecialchars($row['placa']);
                    echo "<option value='$id_veiculo'>$placa_veiculo</option>";
                }
            }
            ?>
        </select><br><br>

        <!-- Data de Aluguel -->
        <label for="data_aluguel">Data de Aluguel:</label>
        <input type="date" id="data_aluguel" name="data_aluguel" required><br><br>

        <button type="submit">Confirmar Aluguel</button> <br><br>

        <a href="index.html">Clique aqui para voltar ao início!</a>
    </form>
</body>
</html>