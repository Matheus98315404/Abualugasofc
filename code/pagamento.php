<?php
require_once 'conexao.php';

// Carregar dados do banco de dados para os selects
$funcionarios_options = '';
$clientes_options = '';
$veiculos_options = '';

$result_funcionarios = mysqli_query($conexao, "SELECT id_funcionario, nome FROM funcionarios");
while ($row = mysqli_fetch_assoc($result_funcionarios)) {
    $funcionarios_options .= "<option value='{$row['id_funcionario']}'>{$row['nome']}</option>";
}

$result_clientes = mysqli_query($conexao, "SELECT id_cliente, nome FROM clientes");
while ($row = mysqli_fetch_assoc($result_clientes)) {
    $clientes_options .= "<option value='{$row['id_cliente']}'>{$row['nome']}</option>";
}

$result_veiculos = mysqli_query($conexao, "SELECT id_veiculo, placa FROM veiculos WHERE disponivel = 1");
while ($row = mysqli_fetch_assoc($result_veiculos)) {
    $veiculos_options .= "<option value='{$row['id_veiculo']}'>{$row['placa']}</option>";
}

// Processar o formulário quando enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_funcionario = $_POST['id_funcionario'];
    $id_cliente = $_POST['id_cliente'];
    $id_veiculo = $_POST['id_veiculo'];
    $data_inicio = $_POST['data_aluguel'];
    $km_inicial = $_POST['km_inicial'];

    $sql = "INSERT INTO alugueis (id_funcionario, id_cliente, id_veiculo, data_inicio, km_inicial)
            VALUES ('$id_funcionario', '$id_cliente', '$id_veiculo', '$data_inicio', '$km_inicial')";

    if (mysqli_query($conexao, $sql)) {
        $sql_update = "UPDATE veiculos SET km_atual = '$km_inicial', disponivel = 0 WHERE id_veiculo = '$id_veiculo'";
        if (mysqli_query($conexao, $sql_update)) {
            echo "Aluguel realizado com sucesso!";
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
    <title>Pagamento</title>
</head>
<body>
    <h2>Realizar Aluguel</h2>
    <form action="pagamento.php" method="POST">
        <label for="funcionario">Funcionário:</label>
        <select id="funcionario" name="id_funcionario" required>
            <?php echo $funcionarios_options; ?>
        </select><br><br>

        <label for="cliente">Cliente:</label>
        <select id="cliente" name="id_cliente" required>
            <?php echo $clientes_options; ?>
        </select><br><br>

        <label for="veiculo">Placa do Veículo:</label>
        <select id="veiculo" name="id_veiculo" required>
            <?php echo $veiculos_options; ?>
        </select><br><br>

        <label for="data_aluguel">Data de Aluguel:</label>
        <input type="date" id="data_aluguel" name="data_aluguel" required><br><br>
                
        <label for="km_inicial">Quilometragem Inicial:</label>
        <input type="number" id="km_inicial" name="km_inicial" required><br><br>
        
        <button type="submit">Confirmar Aluguel</button> <br><br>

        <a href="index.html">Clique aqui para voltar ao início!</a>
    </form>
</body>
</html>
