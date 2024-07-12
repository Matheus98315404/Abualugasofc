<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_funcionario = $_POST['id_funcionario'];
    $id_cliente = $_POST['id_cliente'];
    $id_veiculo = $_POST['id_veiculo'];
    $data_inicio = $_POST['data_aluguel'];
    $km_inicial = $_POST['km_inicial'];

      
    $sql = "INSERT INTO alugueis (id_funcionario, id_cliente, id_veiculo, data_inicio, km_inicial)
    VALUES ('$id_funcionario', '$id_cliente', '$id_veiculo', '$data_inicio', '$km_inicial')";


    if (mysqli_query($conexao, $sql)) {
        // Atualiza a quilometragem do veículo e a disponibilidade
        $sql_update = "UPDATE veiculos SET km_atual = '$km_inicial', disponivel = 0 WHERE id_veiculo = '$id_veiculo'";

        if (mysqli_query($conexao, $sql_update)) {
            //echo "Aluguel realizado com sucesso!";
        } else {
            echo "Erro ao atualizar veículo: " . mysqli_error($conexao);
        }
    } else {
        echo "Erro ao inserir aluguel: " . mysqli_error($conexao);
    }

    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>aluguel</title>
</head>
<body>
    <h2>Realização do aluguel</h2>
    <p>O aluguel foi realizado com sucesso!</p>
    <a href="index.html">Voltar à página inicial</a>
</body>
</html>