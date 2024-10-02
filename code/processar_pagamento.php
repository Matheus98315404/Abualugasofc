<?php
require_once 'conexao.php'; // Conexão com o banco de dados

// Verificar se foram selecionados aluguéis
if (isset($_POST['alugueis_selecionados']) && !empty($_POST['alugueis_selecionados']) && isset($_POST['km_final']) && isset($_POST['metodo_pagamento']) && isset($_POST['data_pagamento'])) {
    $alugueis_selecionados = $_POST['alugueis_selecionados'];
    $km_final = $_POST['km_final'];
    $metodo_pagamento = $_POST['metodo_pagamento'];
    $data_pagamento_input = $_POST['data_pagamento']; // Data recebida do formulário

    // Tente formatar a data
    $data_pagamento = date('Y-m-d', strtotime($data_pagamento_input)); // Formatar a data

    if ($data_pagamento === false) {
        die("Formato de data inválido.");
    }

    $total_geral = 0;

    echo "<h1>Resumo do Pagamento</h1>";
    echo "<table border='1'>
            <tr>
                <th>ID Aluguel</th>
                <th>Modelo do Veículo</th>
                <th>Km Rodados</th>
                <th>Método de Pagamento</th>
                <th>Preço Total</th>
            </tr>";
    
    // Loop através dos aluguéis selecionados
    foreach ($alugueis_selecionados as $id_aluguel) {
        // Consulta para obter as informações do aluguel selecionado
        $sql = "SELECT v.id_veiculo, v.modelo, av.km_inicial, a.valor_km 
                FROM alugueis_veiculos av
                JOIN veiculos v ON av.veiculos_id_veiculo = v.id_veiculo
                JOIN alugueis a ON av.alugueis_id_aluguel = a.id_aluguel
                WHERE av.alugueis_id_aluguel = ?";
        
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id_aluguel);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $modelo_veiculo = $row['modelo'];
            $km_inicial = $row['km_inicial'];
            $valor_km = $row['valor_km'];
            $km_final_value = isset($km_final[$id_aluguel]) ? (int)$km_final[$id_aluguel] : 0;

            // Calcular a quantidade de km rodados
            $km_rodado = $km_final_value - $km_inicial;

            // Calcular o preço total
            $preco_total = $km_rodado * $valor_km;
            $total_geral += $preco_total;

            // Exibir detalhes
            echo "<tr>
                    <td>{$id_aluguel}</td>
                    <td>{$modelo_veiculo}</td>
                    <td>{$km_rodado}</td>
                    <td>{$metodo_pagamento}</td>
                    <td>R$ " . number_format($preco_total, 2, ',', '.') . "</td>
                  </tr>";
            
            // Atualizar a disponibilidade do veículo para 'disponível'
            $id_veiculo = $row['id_veiculo'];
            $sql_atualizar_disponibilidade = "UPDATE veiculos SET disponivel = 0 WHERE id_veiculo = ?";
            $stmt_atualizar = $conexao->prepare($sql_atualizar_disponibilidade);
            $stmt_atualizar->bind_param("i", $id_veiculo);
            $stmt_atualizar->execute();
            $stmt_atualizar->close();
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

    // Inserir o pagamento no banco de dados
    foreach ($alugueis_selecionados as $id_aluguel) {
        $sql_inserir_pagamento = "INSERT INTO pagamentos (valor_pagamento, metodo_pagamento, id_aluguel, data_pagamento) VALUES (?, ?, ?, ?)";
        $stmt_pagamento = $conexao->prepare($sql_inserir_pagamento);
        $stmt_pagamento->bind_param("dssi", $preco_total, $metodo_pagamento, $id_aluguel, $data_pagamento); // Aqui você pode usar preco_total de cada aluguel, se necessário
        $stmt_pagamento->execute();
        $stmt_pagamento->close();
    }

} else {
    echo "Nenhum aluguel selecionado ou quilometragem final não fornecida.";
}

$conexao->close();
?>
