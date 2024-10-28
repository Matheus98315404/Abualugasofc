<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de Veículos</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        .slogan {
            text-align: center;
            margin: 20px 0;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }
        .card {
            width: 18rem;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.html">Carromeu e julieta</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
            </ul>
        </div>
    </div>
</nav>
<div class="container form-container mt-4">
    <h2>Selecione os Veículos</h2>
    <form action="pagina3.php" method="POST">
        <!-- Campo oculto para o ID do funcionário -->
        <input type="hidden" name="id_funcionario" value="<?php echo $_POST['id_funcionario']; ?>">
        <!-- Campo oculto para o ID do cliente -->
        <input type="hidden" name="id_cliente" value="<?php echo $_POST['id_cliente']; ?>">
        <?php
        // Inclui a conexão com o banco de dados
        require_once 'conexao.php';

        // Consulta os veículos disponíveis
        $query_veiculos = "SELECT id_veiculo, placa FROM veiculos WHERE disponivel = 1";
        $result_veiculos = mysqli_query($conexao, $query_veiculos);

        // Exibe os veículos disponíveis em forma de checkboxes
        while ($row = mysqli_fetch_assoc($result_veiculos)) {
            echo "<label><input type='checkbox' name='veiculos[]' value='{$row['id_veiculo']}'> {$row['placa']}</label><br>";
        }
        ?>
        <!-- Botão para enviar o formulário e passar para a próxima etapa -->
        <button type="submit" class="btn btn-custom mt-3">Próxima Etapa</button>
    </form>
</div>
<footer class="footer text-center">
    <p>© 2024 Carromeu e Julieta - Todos os direitos reservados</p>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>