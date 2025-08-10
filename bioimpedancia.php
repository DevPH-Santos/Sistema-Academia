<?php

define('APP_RUNNING', true);
require('src/config.php');

// Verificação da conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

// Consulta para obter as avaliações
$sql = "SELECT * FROM Bioimpedancia ORDER BY data DESC";
$result = $conexao->query($sql);

// Verifica se a consulta foi bem-sucedida
if (!$result) {
    die("Erro na consulta: " . $conexao->error);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tabela.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Cartel - Bioimpedancia</title>
</head>

<body>

    <div class="left-section">
        <a href="index.html"><i class='bx bx-home-alt-2'></i></a>
        <a href="forms/forms.html"><i class='bx bx-file'></i></a>
        <a href="forms/ai.html"><i class='bx bx-bowl-rice'></i></a>
        <a href="dados.html" class="selected"><i class='bx bx-data'></i></a>
    </div>

    <main>

        <div id="progressos">

            <input type="text" id="searchInputProgress" placeholder="Pesquisar progressos..."
                onkeyup="searchProgress();">

            <table id="progressTable">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data</th>
                        <th>Ver mais</th>
                        <th>...</th>
                    </tr>
                </thead>
                <tbody id="progressTable">
                    <?php
                    // Verifica se há resultados e os exibe
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Formata a data para dd/mm/yyyy
                            $data_formatada = date('d/m/Y', strtotime($row['data']));
                            // Criar a mensagem
                            $mensagem = "Bioimpedância de {$row['nome']}\nData: {$data_formatada}\nPeso: {$row['peso']}kg\nGordura Corporal: {$row['gordura_corporal']}%\nMassa Gorda: {$row['massa_gorda']}kg\nMassa Magra: {$row['massa_magra']}kg";
                            $mensagem_url = urlencode($mensagem);

                            echo "<tr>
                                <td>{$row['nome']}</td>
                                <td>{$data_formatada}</td>
                                <td><a href='vermaisBio.php?nome=" . urlencode($row['nome']) . "'>Ver mais</a></td>
                                <td>
                                    <a class='btn-share' href='https://api.whatsapp.com/send?text={$mensagem_url}' target='_blank'>
                                        <i class='bx bx-share'></i>
                                    </a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Nenhum dado encontrado</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>

    </main>

    <script src="js/script.js"></script>

</body>

</html>