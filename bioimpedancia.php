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

            <table id="progressTable" class="name-list">
                <thead>
                    <tr><th>Nome do aluno</th></tr>
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
            <p class="modal-eyebrow">Ficha de bioimpedância</p><h2 id="recordTitle"></h2>
            <div class="record-grid" id="recordDetails"></div>
        </section>
    </div>

    <script src="js/script.js"></script>
    <script>
        const modal = document.getElementById('recordModal');
        const labels = {data:'Data do registro', peso:'Peso (kg)', gordura_corporal:'Gordura corporal (%)', massa_gorda:'Massa gorda (kg)', massa_magra:'Massa magra (kg)'};
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
