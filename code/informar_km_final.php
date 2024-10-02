<?php
if (isset($_POST['alugueis_selecionados']) && !empty($_POST['alugueis_selecionados'])) {
    $alugueis_selecionados = $_POST['alugueis_selecionados'];
    ?>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f8f8f8;
        }

        input[type="number"], input[type="date"], select {
            width: calc(100% - 20px);
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            width: 100%;
        }

        button:hover {
            background-color: #218838;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        .form-section {
            margin-bottom: 20px;
        }
    </style>

    <form method="POST" action="processar_pagamento.php">
        <h1>Informe a Quilometragem Final</h1>
        <input type="hidden" name="alugueis_selecionados[]" value="<?php echo implode('", "',$alugueis_selecionados); ?>">

        <table>
            <tr>
                <th>ID Aluguel</th>
                <th>Modelo do Veículo</th>
                <th>Km Final</th>
            </tr>
            <?php
            // Conexão com o banco de dados
            require_once 'conexao.php';

            // Loop para buscar e exibir o modelo do veículo associado ao id do aluguel
            foreach ($alugueis_selecionados as $id_aluguel):
                $sql = "SELECT v.modelo FROM alugueis_veiculos av
                        JOIN veiculos v ON av.veiculos_id_veiculo = v.id_veiculo
                        WHERE av.alugueis_id_aluguel = ?";
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param("i", $id_aluguel);
                $stmt->execute();
                $result = $stmt->get_result();

                // Buscar o modelo do veículo
                $modelo_veiculo = '';
                if ($row = $result->fetch_assoc()) {
                    $modelo_veiculo = htmlspecialchars($row['modelo']);
                }

                $stmt->close();
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($id_aluguel); ?></td>
                    <td><?php echo $modelo_veiculo; ?></td>
                    <td>
                        <input type="number" name="km_final[<?php echo $id_aluguel; ?>]" required placeholder="Km Final">
                    </td>
                </tr>
                
            <?php endforeach; ?>
        </table>

        

        <div class="form-section">
            <label for="metodo_pagamento">Método de Pagamento:</label>
            <select name="metodo_pagamento" required>
                <option value="Dinheiro">Dinheiro</option>
                <option value="Cartao">Cartão</option>
                <option value="Pix">Pix</option>
                <option value="Outro">Outro</option>
            </select>
        </div>

        <button type="submit">Processar Pagamento</button>
    </form>

    <?php
} else {
    echo "<p style='text-align:center; font-size:18px;'>Nenhum aluguel selecionado.</p>";
}
?>
