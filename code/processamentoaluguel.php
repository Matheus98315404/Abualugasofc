<?php
require_once 'conexao.php';

function kmInicialVeiculo($conexao, $id_veiculo) {
    $sql = "SELECT km_atual FROM veiculos WHERE id_veiculo = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id_veiculo);
    
    if (!mysqli_stmt_execute($stmt)) {
        die('Erro ao obter quilometragem inicial: ' . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_bind_result($stmt, $km_inicial);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    return $km_inicial !== null ? $km_inicial : null;
}

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

    $sql = "INSERT INTO alugueis_veiculos (alugueis_id_aluguel, veiculos_id_veiculo, km_inicial, km_final, id_veiculo) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($stmt, 'iisss', $id_aluguel, $id_veiculo, $km_inicial, $km_final, $id_veiculo);
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

$id_aluguel = salvarEmprestimo($conexao, $id_funcionario, $id_cliente, $data_inicio, $data_fim, $valor_km);

$veiculos_array = explode(',', $_POST['veiculos']);
foreach ($veiculos_array as $veiculo) {
    $id_veiculo = intval($veiculo);
    if (empty($id_veiculo)) {
        continue; 
    }

    salvarVeiculoEmprestimo($conexao, $id_aluguel, $id_veiculo);

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
