<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Realizar Pagamento</h2>
    <form action="" method="POST">
        <label for="id_cliente">ID Cliente:</label>
        <input type="text" id="id_cliente" name="id_cliente" required><br><br>

        <label for="id_aluguel">ID Aluguel:</label>
        <input type="text" id="id_aluguel" name="id_aluguel" required><br><br>

        <label for="km_final">Quilometragem Final:</label>
        <input type="number" id="km_final" name="km_final" required><br><br>

        <label for="metodo_pagamento">Método de Pagamento:</label>
        <select id="metodo_pagamento" name="metodo_pagamento" required>
            <option value="Dinheiro">Dinheiro</option>
            <option value="Cartao">Cartão</option>
            <option value="Pix">Pix</option>
            <option value="Outro">Outro</option>
        </select><br><br>

        <input type="submit" name="submit" value="Pagar"> <br><br>
        <a href="index.html">Clique aqui para voltar ao início!</a>

    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        require_once 'core.php'; // Importa a função buscarNomeSituacaoPorId

        $id_cliente = $_POST['id_cliente'];
        $id_aluguel = $_POST['id_aluguel'];
        $km_final = $_POST['km_final'];
        $metodo_pagamento = $_POST['metodo_pagamento'];

        // Puxar o nome do cliente
        $nome_cliente = buscarNomeSituacaoPorId($ 1);
    
        // Conexão ao banco de dados
        $conn = mysqli_connect("localhost", "usuario", "senha", "nome_do_banco");

        // Verifica a conexão
    }
        if (mysqli_connect_error() === "") {
            // Recupera os dados do aluguel
            $stmt = mysqli_prepare($conn, "SELECT km_inicial, valor_km FROM alugueis WHERE id_aluguel = ? AND id_cliente = ?");
            mysqli_stmt_bind_param($stmt, "ii", $id_aluguel, $id_cliente);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $km_inicial, $valor_km);
            mysqli_stmt_fetch($stmt);

            if ($km_inicial !== null && $valor_km !== null) {
                // Cálculo do valor do pagamento
                $km_rodados = $km_final - $km_inicial;
                $valor_pagamento = $km_rodados * $valor_km;

                echo "<p>Nome do Cliente: " . $nome_cliente . "</p>";
                echo "<p>Quilometragem Inicial: $km_inicial km</p>";
                echo "<p>Quilometragem Final: $km_final km</p>";
                echo "<p>Quilometragem Rodada: $km_rodados km</p>";
                echo "<p>Valor por Km: R$ $valor_km</p>";
                echo "<p>Valor Total do Pagamento: R$ $valor_pagamento</p>";

                // Insere o pagamento na tabela
                $stmt = mysqli_prepare($conn, "INSERT INTO pagamentos (id_aluguel, data_pagamento, valor_pagamento, metodo_pagamento) VALUES (?, CURDATE(), ?, ?)");
                mysqli_stmt_bind_param($stmt, "ids", $id_aluguel, $valor_pagamento, $metodo_pagamento);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<p>Pagamento realizado com sucesso.</p>";
                } else {
                    echo "<p>Erro ao realizar o pagamento.</p>";
                }
            } else {
                echo "<p>Dados de aluguel não encontrados.</p>";
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        } else {
            echo "<p>Falha na conexão com o banco de dados: " . mysqli_connect_error() . "</p>";
        }
    
    ?>
</body>
</html>
