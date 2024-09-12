<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Funcionários - Bootstrap</title>
    <!-- Incluindo o Bootstrap CSS via CDN -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Funcionários</h1>

        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID do Funcionário</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "conexao.php";
                require_once "core.php";

                $resultados = listarFuncionarios($conexao);

                foreach ($resultados as $funcionario) {
                    $id_funcionario = $funcionario[0];
                    echo "<tr>";
                    echo "<td>$id_funcionario</td>";
                    echo "<td>" . htmlspecialchars($funcionario[1]) . "</td>";
                    echo "<td>" . htmlspecialchars($funcionario[2]) . "</td>";
                    echo "<td>" . htmlspecialchars($funcionario[3]) . "</td>";
                    echo "<td>" . htmlspecialchars($funcionario[4]) . "</td>";
                    echo "<td>
                            <a href='editar_funcionario.php?id=$id_funcionario' class='btn btn-warning btn-sm'>Editar</a>
                            <a href='excluir_funcionario.php?id=$id_funcionario' class='btn btn-danger btn-sm'>Excluir</a>
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
