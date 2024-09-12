<?php
require_once "conexao.php";

if (!isset($_GET['id'])) {
    header("Location: listar_carros.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $ano = $_POST['ano'];
    $placa = $_POST['placa'];
    $cor = $_POST['cor'];
    $km_atual = $_POST['km_atual'];
    $tipo = $_POST['tipo'];

    $sql = "UPDATE veiculos SET modelo = ?, marca = ?, ano = ?, placa = ?, cor = ?, km_atual = ?, tipo = ? WHERE id_veiculo = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "sssssisi", $modelo, $marca, $ano, $placa, $cor, $km_atual, $tipo, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirecionar após a atualização
    header("Location: listar_carros.php");
    exit();
} else {
    $sql = "SELECT * FROM veiculos WHERE id_veiculo = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id_veiculo, $modelo, $marca, $ano, $placa, $cor, $km_atual, $tipo, $airbag, $num_bancos, $num_portas, $combustivel, $cambio, $ar_coondicionado, $direcao, $som, $bluetooth, $gps, $sensor_estacionamento, $camera_re, $disponivel);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Carro</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Carro</h1>
        <form method="post">
            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo htmlspecialchars($modelo); ?>" required>
            </div>
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" class="form-control" id="marca" name="marca" value="<?php echo htmlspecialchars($marca); ?>" required>
            </div>
            <div class="form-group">
                <label for="ano">Ano:</label>
                <input type="number" class="form-control" id="ano" name="ano" value="<?php echo htmlspecialchars($ano); ?>" required>
            </div>
            <div class="form-group">
                <label for="placa">Placa:</label>
                <input type="text" class="form-control" id="placa" name="placa" value="<?php echo htmlspecialchars($placa); ?>" required>
            </div>
            <div class="form-group">
                <label for="cor">Cor:</label>
                <input type="text" class="form-control" id="cor" name="cor" value="<?php echo htmlspecialchars($cor); ?>" required>
            </div>
            <div class="form-group">
                <label for="km_atual">Km Atual:</label>
                <input type="number" class="form-control" id="km_atual" name="km_atual" value="<?php echo htmlspecialchars($km_atual); ?>" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo htmlspecialchars($tipo); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="listar_carros.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
