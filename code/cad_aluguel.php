<?php
require_once 'conexao.php';

// Busca os funcionários disponíveis
$result_funcionarios = mysqli_query($conexao, "SELECT id_funcionario, nome FROM funcionarios");

// Busca os clientes disponíveis
$result_clientes = mysqli_query($conexao, "SELECT id_cliente, nome FROM clientes");

// Busca os veículos disponíveis
$result_veiculos = mysqli_query($conexao, "SELECT id_veiculo, placa FROM veiculos WHERE disponivel = 1");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Realizar Aluguel</title>
</head>
<body>
    <h2>Realizar Aluguel</h2>
    <form action="pagamento.php" method="POST">
        <label for="funcionario">Funcionário:</label>
        <select id="funcionario" name="id_funcionario" required>
            <?php while ($row = mysqli_fetch_assoc($result_funcionarios)) { ?>
                <option value="<?php echo $row['id_funcionario']; ?>"><?php echo $row['nome']; ?></option>
            <?php } ?>
        </select><br><br>
        
        <label for="cliente">Cliente:</label>
        <select id="cliente" name="id_cliente" required>
            <?php while ($row = mysqli_fetch_assoc($result_clientes)) { ?>
                <option value="<?php echo $row['id_cliente']; ?>"><?php echo $row['nome']; ?></option>
            <?php } ?>
        </select><br><br>
        
        <label for="veiculo">Placa do veiculo:</label>
        <select id="veiculo" name="id_veiculo" required>
            <?php while ($row = mysqli_fetch_assoc($result_veiculos)) { ?>
                <option value="<?php echo $row['id_veiculo']; ?>"><?php echo $row['placa']; ?></option>
            <?php } ?>
        </select><br><br>
        
        <label for="data_aluguel">Data de Aluguel:</label>
        <input type="date" id="data_aluguel" name="data_aluguel" required><br><br>
                
        <label for="km_inicial">Quilometragem Inicial:</label>
        <input type="number" id="km_inicial" name="km_inicial" required><br><br>
        
       
        
        <button type="submit">confirmar Aluguel</button>
    </form>
</body>
</html>
