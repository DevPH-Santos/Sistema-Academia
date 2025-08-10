<?php

define('APP_RUNNING', true);
require_once('../src/config.php');

// Verifica se o formulário de avaliação foi enviado
if (isset($_POST['submit_avaliacao'])) {

    require_once('../src/config.php');

    // Captura os dados do formulário
    $nome_avaliacao = $_POST['nome_avaliacao'];
    $peso_avaliacao = $_POST['peso_avaliacao'];
    $peito_avaliacao = $_POST['peito_avaliacao'];
    $braco_esq_avaliacao = $_POST['braco_esq_avaliacao'];
    $braco_dir_avaliacao = $_POST['braco_dir_avaliacao'];
    $cintura_avaliacao = $_POST['cintura_avaliacao'];
    $abdomen_avaliacao = $_POST['abdomen_avaliacao'];
    $quadril_avaliacao = $_POST['quadril_avaliacao'];
    $coxa_esq_avaliacao = $_POST['coxa_esq_avaliacao'];
    $coxa_dir_avaliacao = $_POST['coxa_dir_avaliacao'];
    $panturrilha_esq_avaliacao = $_POST['panturrilha_esq_avaliacao'];
    $panturrilha_dir_avaliacao = $_POST['panturrilha_dir_avaliacao'];
    $objetivo_avaliacao = $_POST['objetivo_avaliacao'];
    $data_avaliacao = $_POST['data_avaliacao'];


    // Insere os dados na tabela de avaliações
    $result = mysqli_query($conexao, "INSERT INTO avaliacao(nome_avaliacao ,peso_avaliacao, peito_avaliacao, braco_esq_avaliacao, braco_dir_avaliacao, cintura_avaliacao, abdomen_avaliacao, quadril_avaliacao, coxa_esq_avaliacao, coxa_dir_avaliacao, panturrilha_esq_avaliacao, panturrilha_dir_avaliacao, objetivo_avaliacao, data_avaliacao) 
    VALUES ('$nome_avaliacao' ,'$peso_avaliacao', '$peito_avaliacao', '$braco_esq_avaliacao', '$braco_dir_avaliacao', '$cintura_avaliacao', '$abdomen_avaliacao', '$quadril_avaliacao', '$coxa_esq_avaliacao', '$coxa_dir_avaliacao', '$panturrilha_esq_avaliacao', '$panturrilha_dir_avaliacao', '$objetivo_avaliacao', '$data_avaliacao')");
}

// Consulta para obter as avaliações
$sql = "SELECT * FROM avaliacao ORDER BY data_avaliacao DESC";
$result = $conexao->query($sql);

header('Location: ../progressos.php');
