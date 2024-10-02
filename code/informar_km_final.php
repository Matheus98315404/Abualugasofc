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
            <?php foreach ($alugueis_selecionados as $id_aluguel): ?>
                <tr>
                    <td><?php echo htmlspecialchars($id_aluguel); ?></td>
                    <td>
                        <!-- Aqui você deve buscar e exibir o modelo do veículo associado ao id do aluguel -->
                        <input type="text" name="km_final[<?php echo $id_aluguel; ?>]" required placeholder="Km Final">
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <button type="submit">Processar Pagamento</button>
    </form>

    <?php
} else {
    echo "Nenhum aluguel selecionado.";
}
?>
