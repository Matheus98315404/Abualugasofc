<?php
require_once 'conexao.php';

// Verifica se os dados necessários foram enviados
if (!isset($_POST['id_funcionario'], $_POST['id_cliente'], $_POST['data_inicio'], $_POST['data_fim'], $_POST['valor_km'], $_POST['veiculos'])) {
    die('Dados do formulário incompletos.');
}

$id_funcionario = $_POST['id_funcionario'];
$id_cliente = $_POST['id_cliente'];
$data_inicio = $_POST['data_inicio'];
$data_fim = $_POST['data_fim'];
$valor_km = $_POST['valor_km'];

// Insere os dados do aluguel na tabela 'alugueis'
$query_aluguel = "INSERT INTO alugueis (id_funcionario, id_cliente, data_inicio, data_fim, valor_km) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conexao, $query_aluguel);

if ($stmt === false) {
    die('Erro na preparação da consulta: ' . mysqli_error($conexao));
}

mysqli_stmt_bind_param($stmt, 'iissd', $id_funcionario, $id_cliente, $data_inicio, $data_fim, $valor_km);

if (!mysqli_stmt_execute($stmt)) {
    die('Erro na execução da consulta: ' . mysqli_stmt_error($stmt));
}

$id_aluguel = mysqli_insert_id($conexao);

// Recebe as placas dos veículos enviadas no campo 'veiculos'
$placas_array = explode(',', $_POST['veiculos']);
foreach ($placas_array as $placa) {
    $placa = trim($placa); 
    if (empty($placa)) {
        continue; 
    }

    // Busca o ID do veículo a partir da placa
    $query_busca_veiculo = "SELECT id_veiculo FROM veiculos WHERE placa = ?";
    $stmt_busca_veiculo = mysqli_prepare($conexao, $query_busca_veiculo);
    
    if ($stmt_busca_veiculo === false) {
        die('Erro na preparação da consulta: ' . mysqli_error($conexao));
    }

    mysqli_stmt_bind_param($stmt_busca_veiculo, 's', $placa);
    
    if (!mysqli_stmt_execute($stmt_busca_veiculo)) {
        die('Erro na execução da consulta: ' . mysqli_stmt_error($stmt_busca_veiculo));
    }

    mysqli_stmt_bind_result($stmt_busca_veiculo, $id_veiculo);
    mysqli_stmt_fetch($stmt_busca_veiculo);
    mysqli_stmt_close($stmt_busca_veiculo);

    if (!$id_veiculo) {
        die('Veículo com a placa ' . $placa . ' não encontrado.');
    }

    // Insere na tabela 'veiculo_aluguel' o vínculo do aluguel com o veículo
    $query_veiculo_aluguel = "INSERT INTO veiculo_aluguel (id_aluguel, id_veiculo) VALUES (?, ?)";
    $stmt_veiculo = mysqli_prepare($conexao, $query_veiculo_aluguel);
    
    if ($stmt_veiculo === false) {
        die('Erro na preparação da consulta: ' . mysqli_error($conexao));
    }
    
    mysqli_stmt_bind_param($stmt_veiculo, 'ii', $id_aluguel, $id_veiculo);
    if (!mysqli_stmt_execute($stmt_veiculo)) {
        die('Erro na execução da consulta: ' . mysqli_stmt_error($stmt_veiculo));
    }
    mysqli_stmt_close($stmt_veiculo);

    // Atualiza a disponibilidade do veículo
    $query_atualiza_veiculo = "UPDATE veiculos SET disponivel = 0 WHERE id_veiculo = ?";
    $stmt_atualiza = mysqli_prepare($conexao, $query_atualiza_veiculo);
    
    if ($stmt_atualiza === false) {
        die('Erro na preparação da consulta: ' . mysqli_error($conexao));
    }
    
    mysqli_stmt_bind_param($stmt_atualiza, 'i', $id_veiculo);
    if (!mysqli_stmt_execute($stmt_atualiza)) {
        die('Erro na execução da consulta: ' . mysqli_stmt_error($stmt_atualiza));
    }
    mysqli_stmt_close($stmt_atualiza);
}

mysqli_close($conexao);

echo "Aluguel realizado com sucesso!";
?>
