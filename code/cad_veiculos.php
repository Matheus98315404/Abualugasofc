<?php

require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $ano = $_POST['ano'];
    $placa = $_POST['placa'];
    $cor = $_POST['cor'];
    $km_atual = $_POST['km_atual'];
    $airbag = isset($_POST['airbag']) ? 1 : 0;
    $num_bancos = $_POST['num_bancos'];
    $num_portas = $_POST['num_portas'];
    $combustivel = $_POST['combustivel'];
    $cambio = $_POST['cambio'];
    $ar_condicionado = isset($_POST['ar_condicionado']) ? 1 : 0;
    $direcao = $_POST['direcao'];
    $som = isset($_POST['som']) ? 1 : 0;
    $bluetooth = isset($_POST['bluetooth']) ? 1 : 0;
    $gps = isset($_POST['gps']) ? 1 : 0;
    $sensor_estacionamento = isset($_POST['sensor_estacionamento']) ? 1 : 0;
    $camera_re = isset($_POST['camera_re']) ? 1 : 0;
    $disponivel = isset($_POST['disponivel']) ? 1 : 0;


    $sql = "INSERT INTO veiculos (modelo, marca, ano, placa, cor, km_atual, airbag, num_bancos, num_portas, combustivel, cambio, ar_condicionado, direcao, som, bluetooth, gps, sensor_estacionamento, camera_re, disponivel)
            VALUES ('$modelo', '$marca', '$ano', '$placa', '$cor', '$km_atual', '$airbag', '$num_bancos', '$num_portas', '$combustivel', '$cambio', '$ar_condicionado', '$direcao', '$som', '$bluetooth', '$gps', '$sensor_estacionamento', '$camera_re', '$disponivel')";

}    mysqli_query($conexao, $sql);

    header("Location: cadastrocerto.html")



?>


