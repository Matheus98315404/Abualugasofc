<?php
require_once 'conexao.php'; 

/**
 * Obtém a lista de clientes ordenados por nome.
 */
$sql_clientes = "SELECT id_cliente, nome FROM clientes ORDER BY nome"; 
$stmt_clientes = $conexao->prepare($sql_clientes);
$stmt_clientes->execute();
$result_clientes = $stmt_clientes->get_result();

$id_cliente = null; 
$nome_cliente = ""; 

if (isset($_POST['id_cliente'])) {
    $id_cliente = $_POST['id_cliente'];

    /**
     * Obtém o nome do cliente selecionado.
     * 
     * @param int $id_cliente ID do cliente selecionado.
     */

    $sql_nome_cliente = "SELECT nome FROM clientes WHERE id_cliente = ?";
    $stmt_nome_cliente = $conexao->prepare($sql_nome_cliente);
    $stmt_nome_cliente->bind_param("i", $id_cliente);
    $stmt_nome_cliente->execute();
    $result_nome_cliente = $stmt_nome_cliente->get_result();
    
    if ($row_nome_cliente = $result_nome_cliente->fetch_assoc()) {
        $nome_cliente = $row_nome_cliente['nome'];
    }

    /**
     * Obtém os aluguéis do cliente selecionado.
     * 
     * @param int $id_cliente ID do cliente selecionado.
     */
    
    
     $sql = "SELECT a.id_aluguel, v.modelo AS modelo_veiculo, av.km_atual, av.veiculos_id_veiculo
        FROM alugueis a
        JOIN alugueis_veiculos av ON a.id_aluguel = av.id_aluguel
        JOIN veiculos v ON av.veiculos_id_veiculo = v.id_veiculo
        WHERE a.id_cliente = ?";

    
    $sql = "SELECT modelo, km_atual FROM veiculos WHERE id_veiculo = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_cliente);
    $stmt->execute();
    $result = $stmt->get_result();
} 

?>

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

        <?php if (isset($result) && $result->num_rows > 0): ?>
            <h2>Veículos Alugados</h2>
            <form method="POST" action="informar_km_final.php">
                <table>
                    <tr>
                        <th>Selecionar</th>
                        <th>Modelo do Veículo</th>
                        <th>Km Inicial</th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="aluguel_selecionado" value="<?php echo $row['id_aluguel']; ?>">
                            </td>
                            <td><?php echo htmlspecialchars($row['modelo']); ?></td>
                            <td><?php echo htmlspecialchars($row['km_atual']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
                <button type="submit">Informar Km Final</button>
            </form>
        <?php elseif (isset($result)): ?>
            <p>Nenhum aluguel encontrado para o cliente selecionado.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        require_once 'core.php'; // Importa a função buscarNomeSituacaoPorId

        // Verificação para evitar erros de chaves indefinidas
        $id_cliente = isset($_POST['id_cliente']) ? $_POST['id_cliente'] : null;
        $id_aluguel = isset($_POST['id_aluguel']) ? $_POST['id_aluguel'] : null;
        $km_final = isset($_POST['km_final']) ? $_POST['km_final'] : null;
        $metodo_pagamento = isset($_POST['metodo_pagamento']) ? $_POST['metodo_pagamento'] : null;

        // Validação adicional para garantir que os dados foram fornecidos
        if ($id_cliente && $id_aluguel && $km_final && $metodo_pagamento) {
            // Corrigir a chamada da função para passar os dois parâmetros necessários
            $id_situacao = 1; // Exemplo de valor que pode ser usado
            $nome_cliente = buscarNomeSituacaoPorId($id_cliente, $id_situacao); 

            // Conexão ao banco de dados
            $conn = mysqli_connect("localhost", "usuario", "senha", "nome_do_banco");

            if (!$conn) {
                echo "<p>Falha na conexão com o banco de dados: " . mysqli_connect_error() . "</p>";
            } else {
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
            }
        } else {
            echo "<p>Por favor, preencha todos os campos.</p>";
        }
    }
    ?>

</body>
</html>

