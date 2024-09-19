<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Aluguel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Detalhes do Aluguel</h2>
    <form action="processamento_aluguel.php" method="POST">
        <input type="hidden" name="id_funcionario" value="<?php echo $_POST['id_funcionario']; ?>">
        <input type="hidden" name="id_cliente" value="<?php echo $_POST['id_cliente']; ?>">
        <input type="hidden" name="veiculos" value="<?php echo implode(',', $_POST['veiculos']); ?>">

        <label for="data_inicio">Data de Início:</label>
        <input type="date" id="data_inicio" name="data_inicio" required><br><br>

        <label for="data_fim">Data Prevista de Entrega:</label>
        <input type="date" id="data_fim" name="data_fim" required><br><br>

        <label for="valor_km">Valor do KM Rodado:</label>
        <input type="number" id="valor_km" name="valor_km" step="0.01" required><br><br>

        <button type="submit">Confirmar Aluguel</button>
    </form>
</body>
</html>
