<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de Funcionário e Cliente</title>
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
        .form-heading {
            margin-bottom: 20px;
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
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-container">
            <h2 class="form-heading text-center">Selecione Funcionário e Cliente</h2>
            <form action="pagina2.php" method="POST">
                <div class="mb-3">
                    <label for="funcionario" class="form-label">Funcionário:</label>
                    <select id="funcionario" name="id_funcionario" class="form-select" required>
                        <?php
                        require_once 'conexao.php';
                        $query_funcionarios = "SELECT id_funcionario, nome FROM funcionarios";
                        $result_funcionarios = mysqli_query($conexao, $query_funcionarios);
                        while ($row = mysqli_fetch_assoc($result_funcionarios)) {
                            echo "<option value='{$row['id_funcionario']}'>{$row['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cliente" class="form-label">Cliente:</label>
                    <select id="cliente" name="id_cliente" class="form-select" required>
                        <?php
                        $query_clientes = "SELECT id_cliente, nome FROM clientes";
                        $result_clientes = mysqli_query($conexao, $query_clientes);
                        while ($row = mysqli_fetch_assoc($result_clientes)) {
                            echo "<option value='{$row['id_cliente']}'>{$row['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-custom">Próxima Etapa</button>
                    <a href="index.html" class="btn btn-back ms-2">Voltar ao Início</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
