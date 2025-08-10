<?php

define('APP_RUNNING', true);
require_once('../src/config.php');

if (isset($_POST['submit_anamnese'])) {

    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $ja_treinou = $_POST['ja_treinou'];
    $tempo_treinando = $_POST['tempo_treinando'];
    $tempo_sem_atividade = $_POST['tempo_sem_atividade'];
    $objetivo = $_POST['objetivo'];
    $frequencia_semanal = $_POST['frequencia_semanal'];
    $tempo_treino_por_dia = $_POST['tempo_treino_por_dia'];
    $doenca_problema_saude = $_POST['doenca_problema_saude'];
    $limitacao_movimento = $_POST['limitacao_movimento'];
    $dor_em_movimento = $_POST['dor_em_movimento'];
    $cirurgias = $_POST['cirurgias'];
    $medicamento_controlado = $_POST['medicamento_controlado'];
    $dieta = $_POST['dieta'];
    $consumo_alcool = $_POST['consumo_alcool'];
    $fuma = $_POST['fuma'];

    // Verifica se já existe um registro com o mesmo nome
    $verifica_nome = mysqli_query($conexao, "SELECT id FROM Anamnese WHERE nome = '$nome'");

    if (mysqli_num_rows($verifica_nome) > 0) {
        // Já existe uma pessoa com esse nome
        echo "<script>alert('Já existe uma ficha cadastrada com esse nome. Por favor, escolha um nome diferente.'); window.location.href = '../anamnese.php';</script>";
        exit();
    }

    // Insere os dados na tabela de anamnese
    $result = mysqli_query($conexao, "INSERT INTO Anamnese(nome, idade, ja_treinou, tempo_treinando, tempo_sem_atividade, objetivo, frequencia_semanal, tempo_treino_por_dia, doenca_problema_saude, limitacao_movimento, dor_em_movimento, cirurgias, medicamento_controlado, dieta, consumo_alcool, fuma) 
    VALUES ('$nome', '$idade', '$ja_treinou', '$tempo_treinando', '$tempo_sem_atividade', '$objetivo', '$frequencia_semanal', '$tempo_treino_por_dia', '$doenca_problema_saude', '$limitacao_movimento', '$dor_em_movimento', '$cirurgias', '$medicamento_controlado', '$dieta', '$consumo_alcool', '$fuma')");

    // Redireciona após a inserção
    header('Location: ../anamnese.php');
    exit();
}

// Consulta para obter as avaliações
$sql = "SELECT * FROM Anamnese ORDER BY id DESC";
$result = $conexao->query($sql);

/*CREATE TABLE Anamnese (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    idade INT NOT NULL,
    ja_treinou ENUM('Sim', 'Não') NOT NULL,
    tempo_treinando VARCHAR(50) NOT NULL,
    tempo_sem_atividade VARCHAR(50) NOT NULL,
    objetivo VARCHAR(255) NOT NULL,
    frequencia_semanal INT NOT NULL,
    tempo_treino_por_dia INT NOT NULL,
    doenca_problema_saude VARCHAR(255) NOT NULL,
    limitacao_movimento VARCHAR(255) NOT NULL,
    dor_em_movimento VARCHAR(255) NOT NULL,
    cirurgias VARCHAR(255) NOT NULL,
    medicamento_controlado VARCHAR(255) NOT NULL,
    dieta ENUM('Sim', 'Não') NOT NULL,
    consumo_alcool ENUM('Sim', 'Não') NOT NULL,
    fuma ENUM('Sim', 'Não') NOT NULL
); */
