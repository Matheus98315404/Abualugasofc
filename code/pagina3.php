<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Aluguel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> 
        body {
            background-color: #f5f7fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
        .back-link {
            display: block;
            margin-top: 20px;
            color: #4a90e2;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .btn-group-custom {
            margin-top: 20px;
            text-align: center;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .navbar-nav .nav-link {
            color: #ffffff !important;
        }
        .navbar-nav .nav-link:hover {
            background-color: #495057;
            border-radius: 5px;
        }
        .footer {
            margin-top: auto;
            padding: 20px 0;
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">Abualugas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-container">
            <h2 class="form-heading text-center">Detalhes do Aluguel</h2>
            <form action="processamentoaluguel.php" method="POST">
                <input type="hidden" name="id_funcionario" value="<?php echo $_POST['id_funcionario']; ?>">
                <input type="hidden" name="id_cliente" value="<?php echo $_POST['id_cliente']; ?>">
                <input type="hidden" name="veiculos" value="<?php echo implode(',', $_POST['veiculos']); ?>">

                <div class="mb-3">
                    <label for="data_inicio" class="form-label">Data de Início:</label>
                    <input type="date" id="data_inicio" name="data_inicio" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="data_fim" class="form-label">Data Prevista de Entrega:</label>
                    <input type="date" id="data_fim" name="data_fim" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="valor_km" class="form-label">Valor do KM Rodado:</label>
                    <input type="number" id="valor_km" name="valor_km" class="form-control" step="0.01" required>
                </div>

                <button type="submit" class="btn btn-custom">Confirmar Aluguel</button>
            </form>
        </div>
    </div>
    
    <footer class="footer text-center">
    <p>© 2024 Carromeu e Julieta - Todos os direitos reservados</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>