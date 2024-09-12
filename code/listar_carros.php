<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Carros - Bootstrap</title>
    <!-- Incluindo o Bootstrap CSS via CDN -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Carros</h1>

        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Id do veiculo</th>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Ano</th>
                    <th>Placa</th>
                    <th>Cor</th>
                    <th>Km atual</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <tbody>
    <?php
    require_once "conexao.php";
    require_once "core.php";

    $resultados = listarCarros($conexao);

    foreach ($resultados as $modelo) {
        $id_veiculo = $modelo[0];
        echo "<tr>";
        echo "<td>$id_veiculo</td>";
        echo "<td>$modelo[1]</td>";
        echo "<td>$modelo[2]</td>";
        echo "<td>$modelo[3]</td>";
        echo "<td>$modelo[4]</td>";
        echo "<td>$modelo[5]</td>";
        echo "<td>$modelo[6]</td>";
        echo "<td>$modelo[7]</td>";
        echo "<td>
                <a href='editar.php?id=$id_veiculo' class='btn btn-warning btn-sm'>Editar</a>
                <a href='excluir.php?id=$id_veiculo' class='btn btn-danger btn-sm'>Excluir</a>
              </td>";
        echo "</tr>";
    }
    ?>
</tbody>

        </table>

        <div class="text-center mt-4">
            <a href="index.html" class="btn btn-primary"><< Página inicial</a><br><br>
        </div>
    </div>

    <!-- Incluindo o Bootstrap JS e dependências via CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
