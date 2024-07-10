<?php

require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST['cliente'];
    $carro_id = $_POST['carro_id'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];
    $valor = $_POST['valor'];

    $sql = "INSERT INTO alugueis (cliente, carro_id, data_inicio, data_fim, valor)
            VALUES ('$id_cliente', '$id_veiculo', '$data_inicio', '$data_fim', '$valor_total')";

    if (mysqli_query($conexao, $sql)) {
        header("Location: alugueisuccesso.html");
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
    }
}

mysqli_close($conexao);

?>
