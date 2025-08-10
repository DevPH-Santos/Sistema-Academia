<?php

define('APP_RUNNING', true);
require('src/config.php');

// Verificação da conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

//$nome = isset($_GET['nome']) ? urldecode($_GET['nome']) : '';
$nome_avaliacao = isset($_GET['nome_avaliacao']) ? urldecode($_GET['nome_avaliacao']) : '';
$sql = "SELECT * FROM avaliacao" . ($nome_avaliacao ? " WHERE nome_avaliacao LIKE '%$nome_avaliacao%'" : "") . " ORDER BY data_avaliacao DESC";
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/tabela.css">
    <title>CARTEL - Progressos</title>
    <style>
        @media screen and (max-width: 1400px) {

            #progressos table,
            .acoes a {
                font-size: 12px;
            }
        }

        main {
            display: flex;
            flex-direction: column;
        }

        button {
            margin: 20px 0;
            background-color: #D32F2F;
            border-radius: 4px;
            color: white;
            padding: 15px;
            border: none;
            outline: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #bb2929;
        }
    </style>
</head>

<body>

    <main>

        <div id="progressos">

            <a class="backhome" id="backhome" href="progressos.php">VOLTAR</a>

            <table class="table" id="progressTable">
                <input type="text" id="searchInputProgress" placeholder="Pesquisar progressos..."
                    onkeyup="searchProgress();" value='<?= $nome_avaliacao ?>'>
                <thead>
                    <tr>
                        <th scope="col">Aluno</th>
                        <th scope="col">Data</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Peitoral</th>
                        <th scope="col">Braço E</th>
                        <th scope="col">Braço D</th>
                        <th scope="col">Cintura</th>
                        <th scope="col">Abdômen</th>
                        <th scope="col">Quadril</th>
                        <th scope="col">Coxa E</th>
                        <th scope="col">Coxa D</th>
                        <th scope="col">Panturrilha E</th>
                        <th scope="col">Panturrilha D</th>
                        <th scope="col">Objetivo</th>
                        <th scope="col">...</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($user_data = mysqli_fetch_assoc($result)) {
                        $mensagem = "Protocolo projeto assimetria: " . $user_data['nome_avaliacao'] . "\n"
                            . "Data: " . $user_data['data_avaliacao'] . "\n"
                            . "Peso: " . $user_data['peso_avaliacao'] . " kg\n"
                            . "Peitoral: " . $user_data['peito_avaliacao'] . " cm\n"
                            . "Braço Esquerda: " . $user_data['braco_esq_avaliacao'] . " cm\n"
                            . "Braço Direita: " . $user_data['braco_dir_avaliacao'] . " cm\n"
                            . "Cintura: " . $user_data['cintura_avaliacao'] . " cm\n"
                            . "Abdômen: " . $user_data['abdomen_avaliacao'] . " cm\n"
                            . "Quadril: " . $user_data['quadril_avaliacao'] . " cm\n"
                            . "Coxa Esquerda: " . $user_data['coxa_esq_avaliacao'] . " cm\n"
                            . "Coxa Direita: " . $user_data['coxa_dir_avaliacao'] . " cm\n"
                            . "Panturrilha Esquerda: " . $user_data['panturrilha_esq_avaliacao'] . " cm\n"
                            . "Panturrilha Direita: " . $user_data['panturrilha_dir_avaliacao'] . " cm\n"
                            . "Objetivo: " . $user_data['objetivo_avaliacao'] . "\n\n";

                        $mensagem_url = urlencode($mensagem);

                        echo "<tr>";
                        echo "<td>" . $user_data['nome_avaliacao'] . "</td>";
                        echo "<td>" . date("d-m-Y", strtotime($user_data['data_avaliacao'])) . "</td>";
                        echo "<td>" . $user_data['peso_avaliacao'] . "</td>";
                        echo "<td>" . $user_data['peito_avaliacao'] . "</td>";
                        echo "<td>" . $user_data['braco_esq_avaliacao'] . "</td>";
                        echo "<td>" . $user_data['braco_dir_avaliacao'] . "</td>";
                        echo "<td>" . $user_data['cintura_avaliacao'] . "</td>";
                        echo "<td>" . $user_data['abdomen_avaliacao'] . "</td>";
                        echo "<td>" . $user_data['quadril_avaliacao'] . "</td>";
                        echo "<td>" . $user_data['coxa_esq_avaliacao'] . "</td>";
                        echo "<td>" . $user_data['coxa_dir_avaliacao'] . "</td>";
                        echo "<td>" . $user_data['panturrilha_esq_avaliacao'] . "</td>";
                        echo "<td>" . $user_data['panturrilha_dir_avaliacao'] . "</td>";
                        echo "<td>" . $user_data['objetivo_avaliacao'] . "</td>";
                        echo "<td class='acoes'>
                    <a class='btn-delete' href='acoes/deleteeditprogressos.php?pk_cod_avaliacao={$user_data['pk_cod_avaliacao']}'><i class='bx bx-trash'></i></a>
                    <a class='btn-edit' href='acoes/editprogressos.php?pk_cod_avaliacao={$user_data['pk_cod_avaliacao']}'><i class='bx bx-edit-alt'></i></a>
                    <a class='btn-share' href='https://api.whatsapp.com/send?text=$mensagem_url' target='_blank'><i class='bx bx-share'></i></a>
                </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>

        <?php
        $datas = [];
        $pesos = [];
        $peitoral = [];
        $braco_e = [];
        $braco_d = [];
        $cintura = [];
        $abdomen = [];
        $quadril = [];
        $coxa_e = [];
        $coxa_d = [];
        $panturrilha_e = [];
        $panturrilha_d = [];

        $result->data_seek(0);

        while ($row = $result->fetch_assoc()) {
            $datas[] = $row['data_avaliacao'];
            $pesos[] = $row['peso_avaliacao'];
            $peitoral[] = $row['peito_avaliacao'];
            $braco_e[] = $row['braco_esq_avaliacao'];
            $braco_d[] = $row['braco_dir_avaliacao'];
            $cintura[] = $row['cintura_avaliacao'];
            $abdomen[] = $row['abdomen_avaliacao'];
            $quadril[] = $row['quadril_avaliacao'];
            $coxa_e[] = $row['coxa_esq_avaliacao'];
            $coxa_d[] = $row['coxa_dir_avaliacao'];
            $panturrilha_e[] = $row['panturrilha_esq_avaliacao'];
            $panturrilha_d[] = $row['panturrilha_dir_avaliacao'];
        }
        ?>

        <button onclick="gerarPdf()"><i class='bx bxs-download'></i></button>

        <canvas id="graficoBio" style="max-width: 100%; overflow-x: scroll;  max-height: 350px;"></canvas>

    </main>

    <script src="js/script.js"></script>

    <script>
        const ctx = document.getElementById('graficoBio').getContext('2d');

        const grafico = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($datas) ?>,
                datasets: [{
                        label: 'Peso (kg)',
                        data: <?= json_encode($pesos) ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)' // Cor alterada
                    },
                    {
                        label: 'Peitoral (cm)',
                        data: <?= json_encode($peitoral) ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)' // Cor alterada
                    },
                    {
                        label: 'Braço Esq (cm)',
                        data: <?= json_encode($braco_e) ?>,
                        backgroundColor: 'rgba(255, 206, 86, 0.7)' // Cor alterada
                    },
                    {
                        label: 'Braço Dir (cm)',
                        data: <?= json_encode($braco_d) ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)' // Cor alterada
                    },
                    {
                        label: 'Cintura (cm)',
                        data: <?= json_encode($cintura) ?>,
                        backgroundColor: 'rgba(153, 102, 255, 0.7)' // Cor alterada
                    },
                    {
                        label: 'Abdômen (cm)',
                        data: <?= json_encode($abdomen) ?>,
                        backgroundColor: 'rgba(255, 159, 64, 0.7)' // Cor alterada
                    },
                    {
                        label: 'Quadril (cm)',
                        data: <?= json_encode($quadril) ?>,
                        backgroundColor: 'rgba(255, 99, 71, 0.7)' // Cor alterada
                    },
                    {
                        label: 'Coxa Esq (cm)',
                        data: <?= json_encode($coxa_e) ?>,
                        backgroundColor: 'rgba(0, 255, 0, 0.7)' // Cor alterada
                    },
                    {
                        label: 'Coxa Dir (cm)',
                        data: <?= json_encode($coxa_d) ?>,
                        backgroundColor: 'rgba(0, 0, 255, 0.7)' // Cor alterada
                    },
                    {
                        label: 'Panturrilha Esq (cm)',
                        data: <?= json_encode($panturrilha_e) ?>,
                        backgroundColor: 'rgba(128, 0, 128, 0.7)' // Cor alterada
                    },
                    {
                        label: 'Panturrilha Dir (cm)',
                        data: <?= json_encode($panturrilha_d) ?>,
                        backgroundColor: 'rgba(255, 20, 147, 0.7)' // Cor alterada
                    },
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
                        <title>Protocolo de Assimetria</title>
                        <style>
                            body { font-family: Arial, sans-serif; display: flex; flex-direction: column; align-items: center; margin: 0; padding: 0; display: flex; flex-direction: column; }
                            img.grafico { max-width: 100%; height: auto; margin-top: 20px; }
                            table { border-collapse: collapse; width: 100%; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); border: 1px solid #ddd; }
                            table thead { background-color: #D32F2F; color: #ffffff; }
                            table th, table td { padding: 5px; text-align: center; border: 1px solid #ddd; font-size: 10px; }
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