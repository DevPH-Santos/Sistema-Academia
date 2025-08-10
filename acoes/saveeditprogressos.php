<?php

define('APP_RUNNING', true);
require_once('../src/config.php');

if (isset($_POST['update_avaliacao'])) {

    // Capturando dados do formulário na mesma ordem que no SQL
    $pk_cod_avaliacao = $_POST['pk_cod_avaliacao'];
    $nome_avaliacao = $_POST['nome_avaliacao'];
    $peso_avaliacao = $_POST['peso_avaliacao'];
    $objetivo_avaliacao = $_POST['objetivo_avaliacao']; // Mover esta linha aqui
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
    $data_avaliacao = $_POST['data_avaliacao'];

    // Query de atualização
    $sqlUpdate = "UPDATE avaliacao 
                    SET nome_avaliacao='$nome_avaliacao', 
                        peso_avaliacao='$peso_avaliacao', 
                        objetivo_avaliacao='$objetivo_avaliacao', 
                        peito_avaliacao='$peito_avaliacao', 
                        braco_esq_avaliacao='$braco_esq_avaliacao', 
                        braco_dir_avaliacao='$braco_dir_avaliacao', 
                        cintura_avaliacao='$cintura_avaliacao',
                        abdomen_avaliacao='$abdomen_avaliacao', 
                        quadril_avaliacao='$quadril_avaliacao', 
                        coxa_esq_avaliacao='$coxa_esq_avaliacao', 
                        coxa_dir_avaliacao='$coxa_dir_avaliacao', 
                        panturrilha_esq_avaliacao='$panturrilha_esq_avaliacao', 
                        panturrilha_dir_avaliacao='$panturrilha_dir_avaliacao', 
                        data_avaliacao='$data_avaliacao' 
                    WHERE pk_cod_avaliacao='$pk_cod_avaliacao'";

    // Executando a query
    $result = $conexao->query($sqlUpdate);
}

// Redirecionamento após atualização
header('Location: ../progressos.php');
