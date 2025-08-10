<?php

define('APP_RUNNING', true);
require('src/config.php');

// Verificação da conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

$nome = isset($_GET['nome']) ? urldecode($_GET['nome']) : '';
$sql = "SELECT * FROM Bioimpedancia WHERE nome LIKE '%$nome%' ORDER BY data DESC";
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Cartel - Bioimpedancia</title>
    <style>
        main {
            display: flex;
            flex-direction: column;
        }

        .backhome {
            font-size: 18px;
            color: #D32F2F;
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
        <a href="index.html"><i class='bx bx-home-alt-2'></i></a>
        <a href="forms/forms.html"><i class='bx bx-file'></i></a>
        <a href="forms/ai.html"><i class='bx bx-bowl-rice'></i></a>
        <a href="dados.html" class="selected"><i class='bx bx-data'></i></a>
    </div>

    <main>

        <a class="backhome" href="bioimpedancia.php">Voltar</a>

        <div id="progressos">

            <table id="progressTable">
                <input type="text" id="searchInputProgress" placeholder="Pesquisar progressos..."
                    onkeyup="searchProgress();" value='<?= $nome ?>'>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data</th>
                        <th>Peso</th>
                        <th>Gordura corporal</th>
                        <th>Massa Gorda</th>
                        <th>Massa Magra</th>
                        <th>...</th>
                    </tr>
                </thead>
                <tbody id="progressTable">
                    <?php
                    // Verifica se há resultados e os exibe
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $data_formatada = date('d/m/Y', strtotime($row['data']));

                            // Criar a mensagem
                            $mensagem = "Bioimpedância de {$row['nome']}\nData: {$data_formatada}\nPeso: {$row['peso']}kg\nGordura Corporal: {$row['gordura_corporal']}%\nMassa Gorda: {$row['massa_gorda']}kg\nMassa Magra: {$row['massa_magra']}kg";
                            $mensagem_url = urlencode($mensagem);

                            // Exibir linha da tabela
                            echo "<tr>
                                <td>{$row['nome']}</td>
                                <td>{$data_formatada}</td>
                                <td>{$row['peso']}kg</td>
                                <td>{$row['gordura_corporal']}%</td>
                                <td>{$row['massa_gorda']}kg</td>
                                <td>{$row['massa_magra']}kg</td>
                                <td class='acoes'>
                                    <a class='btn-share' href='https://api.whatsapp.com/send?text={$mensagem_url}' target='_blank'>
                                        <i class='bx bx-share'></i>
                                    </a>
                                    <a class='btn-delete' href='acoes/deleteBio.php?id={$row['id']}'><i class='bx bx-trash'></i></a>
                                    <button onclick='gerarPdf()'><i class='bx bxs-download'></i></button>

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

        <?php
        // Arrays para armazenar os dados do gráfico
        $datas = [];
        $massasMagras = [];
        $massasGordas = [];
        $percentGordura = [];

        // Reinicie o ponteiro do resultado da query
        $result->data_seek(0);

        while ($row = $result->fetch_assoc()) {
            $datas[] = date('d/m', strtotime($row['data']));
            $massasMagras[] = $row['massa_magra'];
            $massasGordas[] = $row['massa_gorda'];
            $percentGordura[] = $row['gordura_corporal'];
        }
        ?>

        <canvas id="graficoBio" style="max-width: 100%; overflow-x: scroll; max-height: 350px;"></canvas>

    </main>

    <script src="js/script.js"></script>

    <script>
        const ctx = document.getElementById('graficoBio').getContext('2d');

        const grafico = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($datas) ?>,
                datasets: [{
                        label: 'Massa Magra (kg)',
                        data: <?= json_encode($massasMagras) ?>,
                        backgroundColor: 'rgba(212, 70, 255, 0.7)'
                    },
                    {
                        label: 'Massa Gorda (kg)',
                        data: <?= json_encode($massasGordas) ?>,
                        backgroundColor: 'rgba(255, 135, 23, 0.7)'
                    },
                    {
                        label: '% Gordura Corporal',
                        data: <?= json_encode($percentGordura) ?>,
                        backgroundColor: 'rgba(0, 95, 184, 0.7)'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Progresso de Composição Corporal'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        function gerarPdf() {
            const tabela = document.getElementById('progressTable');
            const canvas = document.getElementById('graficoBio');
            const imagemGrafico = canvas.toDataURL('image/png');

            const novaJanela = window.open('', '', 'height=1000,width=1000');

            novaJanela.document.write(`
                <html>
                    <head>
                        <title>Relatório de Bioimpedância</title>
                        <style>
                            body { font-family: Arial, sans-serif; display: flex; flex-direction: column; align-items: center; margin: 20px; display: flex; flex-direction: column; }
                            img.grafico { max-width: 500px; height: auto; margin-top: 20px; }
                            table { border-collapse: collapse; width: 100%; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); border: 1px solid #ddd; }
                            table thead { background-color: #D32F2F; color: #ffffff; }
                            table th, table td { font-weight: normal; padding: 5px; text-align: center; border: 1px solid #ddd; }
                            table tbody tr:nth-child(even) { background-color: #f9f9f9; }
                            table tbody tr:nth-child(odd) { background-color: #ffffff; }
                        </style>
                    </head>
                    <body>

                        <img src="imagens/logo.png" style="width: 200px; height: 200px; margin: 0 auto;">

                        ${tabela.outerHTML}

                        <div class="img-container">
                            <img id="graficoImg" src="${imagemGrafico}" class="grafico">
                        </div>
                    </body>
                </html>
            `);

            // Espera o conteúdo da nova janela carregar totalmente antes de imprimir
            novaJanela.document.close();
            novaJanela.onload = function() {
                setTimeout(() => {
                    novaJanela.focus();
                    novaJanela.print();
                    novaJanela.close();
                }, 500); // Pequeno delay para garantir que a imagem carregue
            };
        }
    </script>


</body>

</html>