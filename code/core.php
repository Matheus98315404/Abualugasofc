<?php

function listarCarros($conexao)
{
    $sql = "SELECT * FROM veiculos";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $id_veiculo, $modelo, $marca, $ano, $placa, $cor, $km_atual, $tipo, $airbag, $num_bancos, $num_portas, $combustivel, $cambio, $ar_coondicionado, $direcao, $som, $bluetooth, $gps, $sensor_estacionamento, $camera_re, $disponivel);

    mysqli_stmt_store_result($stmt);

    $lista = [];
    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
            // $situacao = buscarNomeSituacaoPorId($conexao, $id_veiculo);

            $lista[] = [$id_veiculo, $modelo, $marca, $ano, $placa, $cor, $km_atual, $tipo, $airbag, $num_bancos, $num_portas, $combustivel, $cambio, $ar_coondicionado, $direcao, $som, $bluetooth, $gps, $sensor_estacionamento, $camera_re, $disponivel];
        }
    }

    mysqli_stmt_close($stmt);
    // echo $lista;
    return $lista;
}

// function listarSituacoes($conexao)
// {
//    $sql = "SELECT * FROM veiculos";
//
//    $stmt = mysqli_prepare($conexao, $sql);
//
//  mysqli_stmt_execute($stmt);
//
//    mysqli_stmt_bind_result($stmt, $id_veiculo, $modelo);
//
//    mysqli_stmt_store_result($stmt);
//
//    $lista = [];
//    if (mysqli_stmt_num_rows($stmt) > 0) {
//        while (mysqli_stmt_fetch($stmt)) {
//            $lista[] = [$id_veiculo, $modelo];
//        }
//    }
//    mysqli_stmt_close($stmt);
//
//   return $lista;
//}

function buscarNomeSituacaoPorId($conexao, $id_veiculo)
{
     $sql = "SELECT id_veiculo FROM veiculos WHERE id_veiculo = ?";

    $stmt = mysqli_prepare($conexao, $sql);

   mysqli_stmt_bind_param($stmt, "i", $id_veiculo);

   mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $modelo);

    if (mysqli_stmt_fetch($stmt)) {
        return $modelo;
     }

     mysqli_stmt_close($stmt);
     }