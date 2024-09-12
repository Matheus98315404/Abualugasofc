<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <!-- Incluindo o Bootstrap CSS via CDN -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Clientes</h1>

        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Carteira de Motorista</th>
                    <th>Validade da Carteira</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "conexao.php";
                require_once "core.php";

                $resultados = listarClientes($conexao);

                foreach ($resultados as $cliente) {
                    $id_cliente = $cliente[0];
                    echo "<tr>";
                    echo "<td>$id_cliente</td>";
                    echo "<td>$cliente[1]</td>";
                    echo "<td>$cliente[2]</td>";
                    echo "<td>$cliente[3]</td>";
                    echo "<td>$cliente[4]</td>";
                    echo "<td>$cliente[5]</td>";
                    echo "<td>$cliente[6]</td>";
                    echo "<td>$cliente[7]</td>";
                    echo "<td>
                            <a href='editar_cliente.php?id=$id_cliente' class='btn btn-warning btn-sm'>Editar</a>
                            <a href='excluir_cliente.php?id=$id_cliente' class='btn btn-danger btn-sm'>Excluir</a>
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
