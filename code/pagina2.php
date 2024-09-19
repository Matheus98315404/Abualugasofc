<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de Veículos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Selecione os Veículos</h2>
    <form action="pagina3.php" method="POST">
        <input type="hidden" name="id_funcionario" value="<?php echo $_POST['id_funcionario']; ?>">
        <input type="hidden" name="id_cliente" value="<?php echo $_POST['id_cliente']; ?>">

        <?php
        require_once 'conexao.php';
        $query_veiculos = "SELECT id_veiculo, placa FROM veiculos WHERE disponivel = 1";
        $result_veiculos = mysqli_query($conexao, $query_veiculos);
        while ($row = mysqli_fetch_assoc($result_veiculos)) {
            echo "<label><input type='checkbox' name='veiculos[]' value='{$row['id_veiculo']}'> {$row['placa']}</label><br>";
        }
        ?>

        <button type="submit">Próxima Etapa</button>
    </form>
</body>
</html>
