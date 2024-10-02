<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
        }
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        .btn-custom {
            background-color: #4a90e2;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #357abd;
        }
        .btn-back {
            background-color: #6c757d;
            color: white;
            border: none;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
        .form-heading {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-container">
            <h2 class="form-heading text-center">Realizar Pagamento</h2>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="id_cliente" class="form-label">ID Cliente:</label>
                    <input type="text" id="id_cliente" name="id_cliente" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="id_aluguel" class="form-label">ID Aluguel:</label>
                    <input type="text" id="id_aluguel" name="id_aluguel" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="km_final" class="form-label">Quilometragem Final:</label>
                    <input type="number" id="km_final" name="km_final" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="metodo_pagamento" class="form-label">Método de Pagamento:</label>
                    <select id="metodo_pagamento" name="metodo_pagamento" class="form-select" required>
                        <option value="Dinheiro">Dinheiro</option>
                        <option value="Cartao">Cartão</option>
                        <option value="Pix">Pix</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-custom">Pagar</button>
                    <a href="index.html" class="btn btn-back ms-2">Voltar ao Início</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        require_once 'core.php'; 

        $id_cliente = isset($_POST['id_cliente']) ? $_POST['id_cliente'] : null;
        $id_aluguel = isset($_POST['id_aluguel']) ? $_POST['id_aluguel'] : null;
        $km_final = isset($_POST['km_final']) ? $_POST['km_final'] : null;
        $metodo_pagamento = isset($_POST['metodo_pagamento']) ? $_POST['metodo_pagamento'] : null;

        if ($id_cliente && $id_aluguel && $km_final && $metodo_pagamento) {
            $id_situacao = 1; // Exemplo de valor que pode ser usado
            $nome_cliente = buscarNomeSituacaoPorId($id_cliente, $id_situacao); 

            $conn = mysqli_connect("localhost", "usuario", "senha", "nome_do_banco");

            if (!$conn) {
                echo "<p>Falha na conexão com o banco de dados: " . mysqli_connect_error() . "</p>";
            } else {
                $stmt = mysqli_prepare($conn, "SELECT km_inicial, valor_km FROM alugueis WHERE id_aluguel = ? AND id_cliente = ?");
                mysqli_stmt_bind_param($stmt, "ii", $id_aluguel, $id_cliente);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $km_inicial, $valor_km);
                mysqli_stmt_fetch($stmt);

                if ($km_inicial !== null && $valor_km !== null) {
                    $km_rodados = $km_final - $km_inicial;
                    $valor_pagamento = $km_rodados * $valor_km;

                    echo "<p>Nome do Cliente: " . $nome_cliente . "</p>";
                    echo "<p>Quilometragem Inicial: $km_inicial km</p>";
                    echo "<p>Quilometragem Final: $km_final km</p>";
                    echo "<p>Quilometragem Rodada: $km_rodados km</p>";
                    echo "<p>Valor por Km: R$ $valor_km</p>";
                    echo "<p>Valor Total do Pagamento: R$ $valor_pagamento</p>";

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
            }
        } else {
            echo "<p>Por favor, preencha todos os campos.</p>";
        }
    }
    ?>

</body>
</html>

