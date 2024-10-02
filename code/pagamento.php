<?php
require_once 'conexao.php'; // Certifique-se de que o arquivo de conexão ao banco de dados está correto

// Consulta para obter todos os clientes
$sql_clientes = "SELECT id_cliente, nome FROM clientes ORDER BY nome"; 
$stmt_clientes = $conexao->prepare($sql_clientes);
$stmt_clientes->execute();
$result_clientes = $stmt_clientes->get_result();

// Verifica se um cliente foi selecionado
if (isset($_POST['id_cliente'])) {
    $id_cliente = $_POST['id_cliente'];

    // Consulta para buscar os veículos alugados pelo cliente selecionado
    $sql = "SELECT a.id_aluguel, v.modelo AS modelo_veiculo, av.km_inicial
            FROM alugueis a
            JOIN alugueis_veiculos av ON a.id_aluguel = av.alugueis_id_aluguel
            JOIN veiculos v ON av.veiculos_id_veiculo = v.id_veiculo
            WHERE a.id_cliente = ?";
    
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
    <title>Pagamento de Empréstimo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 50%;
            margin: 0 auto;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selecionar Cliente para Pagamento de Empréstimo</h1>
        <form method="POST" action="">
            <select name="id_cliente" required>
                <option value="">Selecione um cliente</option>
                <?php while ($cliente = $result_clientes->fetch_assoc()): ?>
                    <option value="<?php echo $cliente['id_cliente']; ?>">
                        <?php echo htmlspecialchars($cliente['nome']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <button type="submit">Buscar</button>
        </form>

        <?php if (isset($result) && $result->num_rows > 0): ?>
            <h2>Veículos Alugados</h2>
            <table>
                <tr>
                    <th>Modelo do Veículo</th>
                    <th>Km Inicial</th>
                    <th>Pagamento</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['modelo_veiculo']); ?></td>
                        <td><?php echo htmlspecialchars($row['km_inicial']); ?></td>
                        <td><a href="realizar_pagamento.php?id_aluguel=<?php echo $row['id_aluguel']; ?>">Realizar Pagamento</a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php elseif (isset($result)): ?>
            <p>Nenhum veículo encontrado para o cliente selecionado.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Fechar conexões
$stmt_clientes->close(); // Fechar consulta de clientes
if (isset($stmt)) {
    $stmt->close(); // Fechar consulta de veículos, se estiver definido
}
$conexao->close();
?>
