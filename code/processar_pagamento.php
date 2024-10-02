<?php
require_once 'conexao.php'; // Conexão com o banco de dados

// Verificar se foram selecionados aluguéis
if (isset($_POST['alugueis_selecionados']) && !empty($_POST['alugueis_selecionados']) && isset($_POST['km_final'])) {
    $alugueis_selecionados = $_POST['alugueis_selecionados'];
    $km_final = $_POST['km_final'];
    
    // Definir o valor por km rodado
    $preco_por_km = 1.50; // Ajuste este valor conforme necessário

    $total_geral = 0;

    echo "<h1>Resumo do Pagamento</h1>";
    echo "<table border='1'>
            <tr>
                <th>ID Aluguel</th>
                <th>Modelo do Veículo</th>
                <th>Km Rodados</th>
                <th>Preço Total</th>
            </tr>";
    
    // Loop através dos aluguéis selecionados
    foreach ($alugueis_selecionados as $id_aluguel) {
        // Consulta para obter as informações do aluguel selecionado
        $sql = "SELECT v.modelo, av.km_inicial 
                FROM alugueis_veiculos av
                JOIN veiculos v ON av.veiculos_id_veiculo = v.id_veiculo
                WHERE av.alugueis_id_aluguel = ?";
        
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id_aluguel);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $modelo_veiculo = $row['modelo'];
            $km_inicial = $row['km_inicial'];
            $km_final_value = isset($km_final[$id_aluguel]) ? (int)$km_final[$id_aluguel] : 0;

            // Calcular a quantidade de km rodados
            $km_rodado = $km_final_value - $km_inicial;

            // Calcular o preço total
            $preco_total = $km_rodado * $preco_por_km;
            $total_geral += $preco_total;

            // Exibir detalhes
            echo "<tr>
                    <td>{$id_aluguel}</td>
                    <td>{$modelo_veiculo}</td>
                    <td>{$km_rodado}</td>
                    <td>R$ " . number_format($preco_total, 2, ',', '.') . "</td>
                  </tr>";
        }

        // Fechar a consulta
        $stmt->close();
    }

    // Exibir o total geral
    echo "<tr>
            <td colspan='3'><strong>Total Geral</strong></td>
            <td><strong>R$ " . number_format($total_geral, 2, ',', '.') . "</strong></td>
          </tr>";
    echo "</table>";

    // Aqui você pode adicionar a lógica para registrar o pagamento no banco de dados, se necessário
} else {
    echo "Nenhum aluguel selecionado ou quilometragem final não fornecida.";
}

$conexao->close();
?>
