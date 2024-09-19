<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de Funcionário e Cliente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Selecione Funcionário e Cliente</h2>
    <form action="pagina2.php" method="POST">
        <label for="funcionario">Funcionário:</label>
        <select id="funcionario" name="id_funcionario" required>
            <?php
            require_once 'conexao.php';
            $query_funcionarios = "SELECT id_funcionario, nome FROM funcionarios";
            $result_funcionarios = mysqli_query($conexao, $query_funcionarios);
            while ($row = mysqli_fetch_assoc($result_funcionarios)) {
                echo "<option value='{$row['id_funcionario']}'>{$row['nome']}</option>";
            }
            ?>
        </select><br><br>

        <label for="cliente">Cliente:</label>
        <select id="cliente" name="id_cliente" required>
            <?php
            $query_clientes = "SELECT id_cliente, nome FROM clientes";
            $result_clientes = mysqli_query($conexao, $query_clientes);
            while ($row = mysqli_fetch_assoc($result_clientes)) {
                echo "<option value='{$row['id_cliente']}'>{$row['nome']}</option>";
            }
            ?>
        </select><br><br>

        <button type="submit">Próxima Etapa</button>
    </form>
</body>
</html>
