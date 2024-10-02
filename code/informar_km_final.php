<?php
if (isset($_POST['alugueis_selecionados']) && !empty($_POST['alugueis_selecionados'])) {
    $alugueis_selecionados = $_POST['alugueis_selecionados'];
    ?>
    
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

        <label for="data_pagamento">Data do Pagamento:</label>
        <input type="date" name="data_pagamento" required>

        <label for="metodo_pagamento">Método de Pagamento:</label>
        <select name="metodo_pagamento" required>
            <option value="Dinheiro">Dinheiro</option>
            <option value="Cartao">Cartão</option>
            <option value="Pix">Pix</option>
            <option value="Outro">Outro</option>
        </select>

        <button type="submit">Processar Pagamento</button>
    </form>

    <?php
} else {
    echo "Nenhum aluguel selecionado.";
}
?>
