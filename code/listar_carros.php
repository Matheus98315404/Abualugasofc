<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de carros</title>
</head>

<body>
    <h1>Lista de carros</h1>

    <table style="border-style: solid;">
        <tr>
            <td>modelo</td>
            <td>marca</td>
            <td>placa</td>
            <td>cor</td>
        </tr>
        <?php
        require_once "conexao.php";
        require_once "core.php";

        $resultados = listarCarros($conexao);

        foreach ($resultados as $modelo) {
            echo "<tr>";
            echo "<td>$modelo[0]</td>";
            echo "<td>$marca[1]</td>";
            echo "<td>$placa[2]</td>";
            echo "<td>$cor[3]</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <br><a href="index.html"><< Página inicial</a>
</body>

</html>