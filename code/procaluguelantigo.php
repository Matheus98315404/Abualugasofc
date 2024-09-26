<?php
require_once 'conexao.php';


if (!isset($_POST['id_funcionario'], $_POST['id_cliente'], $_POST['id_veiculo'], $_POST['data_inicio'], $_POST['data_fim'], $_POST['valor_km'], $_POST['veiculos'])) {
    die('Dados do formulário incompletos.');
}

$id_funcionario = $_POST['id_funcionario'];
$id_cliente = $_POST['id_cliente'];
$id_veiculo = $_POST['id_veiculo'];
$data_inicio = $_POST['data_inicio'];
$data_fim = $_POST['data_fim'];
$valor_km = $_POST['valor_km'];

$query_aluguel = "INSERT INTO alugueis (id_funcionario, id_cliente, id_veiculo, data_inicio, data_fim, valor_km) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conexao, $query_aluguel);

if ($stmt === false) {
    die('Erro na preparação da consulta: ' . mysqli_error($conexao));
}

mysqli_stmt_bind_param($stmt, 'iissd', $id_funcionario, $id_cliente, $id_veiculo, $data_inicio, $data_fim, $valor_km);

if (!mysqli_stmt_execute($stmt)) {
    die('Erro na execução da consulta: ' . mysqli_stmt_error($stmt));
}

$id_aluguel = mysqli_insert_id($conexao);

$veiculos_array = explode(',', $_POST['veiculos']);
foreach ($veiculos_array as $id_veiculo) {
    $id_veiculo = trim($id_veiculo); 
    if (empty($id_veiculo)) {
        continue; 
    }
    
    $query_veiculo_aluguel = "INSERT INTO alugueis (id_aluguel, id_veiculo) VALUES (?, ?)";
    $stmt_veiculo = mysqli_prepare($conexao, $query_veiculo_aluguel);
    
    if ($stmt_veiculo === false) {
        die('Erro na preparação da consulta: ' . mysqli_error($conexao));
    }
    
    mysqli_stmt_bind_param($stmt_veiculo, 'ii', $id_aluguel, $id_veiculo);
    if (!mysqli_stmt_execute($stmt_veiculo)) {
        die('Erro na execução da consulta: ' . mysqli_stmt_error($stmt_veiculo));
    }
}

foreach ($veiculos_array as $id_veiculo) {
    $id_veiculo = trim($id_veiculo); 
    if (empty($id_veiculo)) {
        continue; 
    }
    
    $query_atualiza_veiculo = "UPDATE veiculos SET disponivel = 0 WHERE id_veiculo = ?";
    $stmt_atualiza = mysqli_prepare($conexao, $query_atualiza_veiculo);
    
    if ($stmt_atualiza === false) {
        die('Erro na preparação da consulta: ' . mysqli_error($conexao));
    }
    
    mysqli_stmt_bind_param($stmt_atualiza, 'i', $id_veiculo);
    if (!mysqli_stmt_execute($stmt_atualiza)) {
        die('Erro na execução da consulta: ' . mysqli_stmt_error($stmt_atualiza));
    }
}

mysqli_close($conexao);

echo "Aluguel realizado com sucesso!";
?>


