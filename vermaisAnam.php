<?php

define('APP_RUNNING', true);
require('src/config.php');

// Verificação da conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

// Captura o nome da URL
$nome = isset($_GET['nome']) ? $_GET['nome'] : '';

// Consulta para obter as avaliações filtrando pelo nome
$sql = "SELECT * FROM Anamnese WHERE nome LIKE ? ORDER BY id ASC";
$stmt = $conexao->prepare($sql);
$searchTerm = "%$nome%"; // Adiciona os caracteres de wildcard para busca parcial
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se a consulta foi bem-sucedida
if (!$result) {
    die("Erro na consulta: " . $conexao->error);
}

$mensagem = ""; // Inicializa a variável da mensagem

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tabela.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Cartel - Anamnese</title>
    <style>
        main {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding: 20px;
        }

        .backhome {
            font-size: 18px;
            color: #D32F2F;
        }

        .ficha {
            display: flex;
            flex-direction: column;
            padding: 20px;
            background-color: #f8f8f8;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .dados {
            display: flex;
            justify-content: space-between;
            background-color: white;
            gap: 10px;
            padding: 10px;
            margin: 5px 0;
            border-radius: 3px;
        }

        h4 {
            margin: 0;
        }

        .acoes {
            padding: 20px;
            border: 1px solid #D32F2F;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .acoes a {
            color: white;
            background-color: #D32F2F;
            border-radius: 10px;
            padding: 5px;
        }

        .acoes button {
            background-color: #D32F2F;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="left-section">
        <a href="index.html">
            <i class='bx bx-home-alt-2'></i>
        </a>
        <a href="forms/forms.html">
            <i class='bx bx-file'></i>
        </a>
        <a href="forms/ai.html">
            <i class='bx bx-bowl-rice'></i>
        </a>
        <a href="dados.html" class="selected">
            <i class='bx bx-data'></i>
        </a>
    </div>

    <main>

        <a class="backhome" href="anamnese.php">Voltar</a>

        <?php

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Formata a mensagem com os dados da ficha
                $mensagem .= "Nome: {$row['nome']}\n";
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

                echo "
                    <div class='ficha'>
                        <div class='dados'>
                            <h4>Nome:</h4>
                            <p>{$row['nome']}</p>
                        </div>
                        <div class='dados'>
                            <h4>Idade:</h4>
                            <p>{$row['idade']} anos</p>
                        </div>
                        <div class='dados'>
                            <h4>Já treinou:</h4>
                            <p>{$row['ja_treinou']}</p>
                        </div>
                        <div class='dados'>
                            <h4>Tempo treinando:</h4>
                            <p>{$row['tempo_treinando']}</p>
                        </div>
                        <div class='dados'>
                            <h4>Objetivo:</h4>
                            <p>{$row['objetivo']}</p>
                        </div>
                        <div class='dados'>
                            <h4>Frequência semanal:</h4>
                            <p>{$row['frequencia_semanal']} dias p/semana</p>
                        </div>
                        <div class='dados'>
                            <h4>Tempo de treino p/dia:</h4>
                            <p>{$row['tempo_treino_por_dia']} minutos</p>
                        </div>
                        <div class='dados'>
                            <h4>Problema de saúde:</h4>
                            <p>{$row['doenca_problema_saude']}</p>
                        </div>
                        <div class='dados'>
                            <h4>Deficiência:</h4>
                            <p>{$row['limitacao_movimento']}</p>
                        </div>
                        <div class='dados'>
                            <h4>Dor em movimento:</h4>
                            <p>{$row['dor_em_movimento']}</p>
                        </div>
                        <div class='dados'>
                            <h4>Cirurgias:</h4>
                            <p>{$row['cirurgias']}</p>
                        </div>
                        <div class='dados'>
                            <h4>Medicamento:</h4>
                            <p>{$row['medicamento_controlado']}</p>
                        </div>
                        <div class='dados'>
                            <h4>Fazendo dieta:</h4>
                            <p>{$row['dieta']}</p>
                        </div>
                        <div class='dados'>
                            <h4>Consume álcool:</h4>
                            <p>{$row['consumo_alcool']}</p>
                        </div>
                        <div class='dados'>
                            <h4>Fuma:</h4>
                            <p>{$row['fuma']}</p>
                        </div>
                    </div>
                ";

                $mensagem_url = urlencode($mensagem); // Codifica a mensagem para a URL

                echo "
                    <div class='acoes'>
                        <a class='btn-share' href='https://api.whatsapp.com/send?text={$mensagem_url}' target='_blank'>
                            <i class='bx bx-share'></i>
                        </a>
                        <a class='btn-delete' href='acoes/deleteAnam.php?id={$row['id']}'><i class='bx bx-trash'></i></a>
                        <button onclick='gerarPdf()'><i class='bx bxs-download'></i></button>
                    </div>
                ";
            }
        } else {
            echo "<p>Nenhum dado encontrado</p>";
        }

        $stmt->close();
        $conexao->close();

        ?>

    </main>

    <script src="js/script.js"></script>

    <script>
        function gerarPdf() {
            const ficha = document.querySelector('.ficha');
            const novaJanela = window.open('', '', 'height=1000,width=1000');

            novaJanela.document.write(`
                <html>
                    <head>
                        <title>Ficha de Anamnese</title>
                        <style>
                            body { font-family: Arial, sans-serif; margin: 20px; display: flex; flex-direction: column; align-items: center; }
                            img { width: 205px;}
                            .ficha { width: 80%; padding: 20px; background-color: #ffffff; border: 1px solid #ccc; border-radius: 5px; }
                            .dados { display: flex; justify-content: space-between; padding: 10px; margin: 5px 0; border-bottom: 1px solid #eee; }
                            h4 { margin: 0; color: #D32F2F; }
                        </style>
                    </head>
                    <body>
                        <img src="imagens/logo.png">
                        ${ficha.outerHTML}
                    </body>
                </html>
            `);

            novaJanela.document.close();
            novaJanela.focus();
            novaJanela.print();
            novaJanela.close();
        }
    </script>

</body>

</html>