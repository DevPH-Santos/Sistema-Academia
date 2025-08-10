<?php

define('APP_RUNNING', true);
require('src/config.php');

// Verificação da conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

// Consulta para obter as avaliações
$sql = "SELECT * FROM Anamnese ORDER BY id ASC";
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
    <title>Cartel - Anamnese</title>
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
                        <th>Ver mais</th>
                        <th>...</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Verifica se há resultados e os exibe
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            // Formata a mensagem com os dados da ficha
                            $mensagem = "Nome: {$row['nome']}\n";
                            $mensagem .= "Idade: {$row['idade']} anos\n";
                            $mensagem .= "Já treinou: {$row['ja_treinou']}\n";
                            $mensagem .= "Tempo treinando: {$row['tempo_treinando']}\n";
                            $mensagem .= "Objetivo: {$row['objetivo']}\n";
                            $mensagem .= "Frequência semanal: {$row['frequencia_semanal']} dias p/semana\n";
                            $mensagem .= "Tempo de treino p/dia: {$row['tempo_treino_por_dia']} minutos\n";
                            $mensagem .= "Problema de saúde: {$row['doenca_problema_saude']}\n";
                            $mensagem .= "Deficiência: {$row['limitacao_movimento']}\n";
                            $mensagem .= "Dor em movimento: {$row['dor_em_movimento']}\n";
                            $mensagem .= "Cirurgias: {$row['cirurgias']}\n";
                            $mensagem .= "Medicamento: {$row['medicamento_controlado']}\n";
                            $mensagem .= "Fazendo dieta: {$row['dieta']}\n";
                            $mensagem .= "Consume álcool: {$row['consumo_alcool']}\n";
                            $mensagem .= "Fuma: {$row['fuma']}";

                            $mensagem_url = urlencode($mensagem); // Codifica a mensagem para a URL

                            echo "<tr>
                                <td>{$row['nome']}</td>
                                <td><a href='vermaisAnam.php?nome=" . urlencode($row['nome']) . "'>Ver mais</a></td>
                                <td>
                                    <a class='btn-share' href='https://api.whatsapp.com/send?text={$mensagem_url}' target='_blank'>
                                        <i class='bx bx-share'></i>
                                    </a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Nenhum dado encontrado</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>

    </main>

    <script src="js/script.js"></script>

</body>

</html>