<?php
require_once 'conexao.php';

if (isset($_POST['id_aluguel'], $_POST['km_inicial'], $_POST['km_final'], $_POST['valor_km'])) {
    $id_aluguel = $_POST['id_aluguel'];
    $km_inicial = $_POST['km_inicial'];
    $km_final = $_POST['km_final'];
    $valor_km = $_POST['valor_km'];

    if ($km_final < $km_inicial) {
        echo "Km final não pode ser menor que o Km inicial.";
        exit;
    }

    $km_rodados = $km_final - $km_inicial;
    $valor_total = $km_rodados * $valor_km;

    echo "<h1>Resumo do Pagamento</h1>";
    echo "<p>Km Inicial: $km_inicial</p>";
    echo "<p>Km Final: $km_final</p>";
    echo "<p>Km Rodados: $km_rodados</p>";
    echo "<p>Valor por Km: R$ " . number_format($valor_km, 2, ',', '.') . "</p>";
    echo "<p><strong>Valor Total: R$ " . number_format($valor_total, 2, ',', '.') . "</strong></p>";
} else {
    echo "Dados insuficientes para calcular o valor.";
}
?>
