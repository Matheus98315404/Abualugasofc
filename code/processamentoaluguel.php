<?php
require_once 'conexao.php';

function salvarEmprestimo($conexao, $idfuncionario, $idcliente, $data_inicio, $data_fim, $valor_km) {
    $sql = "INSERT INTO alugueis (id_funcionario, id_cliente, data_inicio, data_fim, valor_km) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'iissd', $idfuncionario, $idcliente, $data_inicio, $data_fim, $valor_km);
    
    if (!mysqli_stmt_execute($stmt)) {
        die('Erro na execução da consulta de aluguel: ' . mysqli_stmt_error($stmt));
    }

    $id = mysqli_insert_id($conexao);
    mysqli_stmt_close($stmt);

    return $id;
}

function salvarVeiculoEmprestimo($conexao, $id_aluguel, $id_veiculo) {
    $km_inicial = kmInicialVeiculo($conexao, $id_veiculo);
    if ($km_inicial === null) {
        die('Erro: quilometragem inicial não encontrada para o veículo ' . $id_veiculo);
    }
    $km_final = 0;

    $sql = "INSERT INTO alugueis_veiculos (id_aluguel, id_veiculo, km_inicial, km_final) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($stmt, 'iiis', $id_aluguel, $id_veiculo, $km_inicial, $km_final);
    if (!mysqli_stmt_execute($stmt)) {
        die('Erro na execução da consulta de veículo: ' . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);
}

if (!isset($_POST['id_funcionario'], $_POST['id_cliente'], $_POST['data_inicio'], $_POST['data_fim'], $_POST['valor_km'], $_POST['veiculos'])) {
    die('Dados do formulário incompletos.');
}

$id_funcionario = $_POST['id_funcionario'];
$id_cliente = $_POST['id_cliente'];
$data_inicio = $_POST['data_inicio'];
$data_fim = $_POST['data_fim'];
$valor_km = $_POST['valor_km'];

// Salva o aluguel
$id_aluguel = salvarEmprestimo($conexao, $id_funcionario, $id_cliente, $data_inicio, $data_fim, $valor_km);

// Salva os veículos do aluguel
$veiculos_array = explode(',', $_POST['veiculos']);
foreach ($veiculos_array as $veiculo) {
    $id_veiculo = intval($veiculo);
    if (empty($id_veiculo)) {
        continue; 
    }

    // Salva na tabela alugueis_veiculos
    salvarVeiculoEmprestimo($conexao, $id_aluguel, $id_veiculo);

    // Atualiza a disponibilidade do veículo
    $query_atualiza_veiculo = "UPDATE veiculos SET disponivel = 0 WHERE id_veiculo = ?";
    $stmt_atualiza = mysqli_prepare($conexao, $query_atualiza_veiculo);
    
    mysqli_stmt_bind_param($stmt_atualiza, 'i', $id_veiculo);
    if (!mysqli_stmt_execute($stmt_atualiza)) {
        die('Erro na execução da consulta de atualização de veículo: ' . mysqli_stmt_error($stmt_atualiza));
    }
}

mysqli_close($conexao);

echo "Aluguel realizado com sucesso!";
?>
