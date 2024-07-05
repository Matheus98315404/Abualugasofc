<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_funcionario = $_POST['id_funcionario'];
    $id_cliente = $_POST['id_cliente'];
    $id_veiculo = $_POST['id_veiculo'];
    $data_aluguel = $_POST['data_aluguel'];
    $data_devolucao = $_POST['data_devolucao'];
    $km_inicial = $_POST['km_inicial'];
    $km_final = $_POST['km_final'];
    
    // Calcula o valor do aluguel baseado na quilometragem rodada
    $km_rodado = $km_final - $km_inicial;
    $valor = $km_rodado * 1; // R$1 por km rodado

    // Insere o aluguel no banco de dados
    $sql = "INSERT INTO alugueis (id_funcionario, id_cliente, id_veiculo, data_aluguel, data_devolucao, valor)
            VALUES ('$id_funcionario', '$id_cliente', '$id_veiculo', '$data_aluguel', '$data_devolucao', '$valor')";
    
    if (mysqli_query($conexao, $sql)) {
        // Atualiza a quilometragem do veículo e a disponibilidade
        mysqli_query($conexao, "UPDATE veiculos SET km_atual = '$km_final', disponivel = 0 WHERE id_veiculo = '$id_veiculo'");
        
        echo "Aluguel realizado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
    }

    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pagamento</title>
</head>
<body>
    <h2>Pagamento</h2>
    <p>O pagamento do valor de R$<?php echo $valor; ?> foi realizado com sucesso.</p>
    <a href="index.html">Voltar à página inicial</a>
</body>
</html>
