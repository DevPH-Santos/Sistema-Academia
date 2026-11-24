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

            <table id="progressTable" class="name-list">
                <thead>
                    <tr><th>Nome do aluno</th></tr>
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

                            $registro_json = htmlspecialchars(json_encode($row, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP), ENT_QUOTES, 'UTF-8');
                            $nome_html = htmlspecialchars($row['nome'], ENT_QUOTES, 'UTF-8');
                            echo "<tr><td><button type='button' class='name-record' data-record='{$registro_json}'>{$nome_html}</button></td></tr>";
                        }
                    } else {
                        echo "<tr><td>Nenhum dado encontrado</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>

    </main>

    <div class="record-modal" id="recordModal" aria-hidden="true">
        <section class="record-dialog" role="dialog" aria-modal="true" aria-labelledby="recordTitle">
            <button class="modal-close" type="button" aria-label="Fechar">&times;</button>
            <p class="modal-eyebrow">Ficha de anamnese</p><h2 id="recordTitle"></h2>
            <div class="record-grid" id="recordDetails"></div>
        </section>
    </div>

    <script src="js/script.js"></script>
    <script>
        const modal = document.getElementById('recordModal');
        const labels = {idade:'Idade', ja_treinou:'Já treinou?', tempo_treinando:'Tempo de treino', objetivo:'Objetivo', frequencia_semanal:'Frequência semanal', tempo_treino_por_dia:'Tempo de treino por dia', doenca_problema_saude:'Problemas de saúde', limitacao_movimento:'Limitações de movimento', dor_em_movimento:'Dores durante movimentos', cirurgias:'Cirurgias', medicamento_controlado:'Medicamentos', dieta:'Segue dieta?', consumo_alcool:'Consumo de álcool', fuma:'Fuma?'};
        document.querySelectorAll('.name-record').forEach(button => button.addEventListener('click', () => {
            const record = JSON.parse(button.dataset.record);
            document.getElementById('recordTitle').textContent = record.nome;
            document.getElementById('recordDetails').innerHTML = Object.entries(labels).map(([key,label]) => `<article class="record-field"><span>${label}</span><strong>${record[key] || '—'}</strong></article>`).join('');
            modal.classList.add('is-open'); modal.setAttribute('aria-hidden','false');
        }));
        modal.querySelector('.modal-close').addEventListener('click', closeRecordModal);
        modal.addEventListener('click', event => { if (event.target === modal) closeRecordModal(); });
        document.addEventListener('keydown', event => { if (event.key === 'Escape') closeRecordModal(); });
        function closeRecordModal(){ modal.classList.remove('is-open'); modal.setAttribute('aria-hidden','true'); }
    </script>

</body>

</html>
