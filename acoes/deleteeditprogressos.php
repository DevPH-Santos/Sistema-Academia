<?php
if (!empty($_GET['pk_cod_avaliacao'])) {

    define('APP_RUNNING', true);
    require_once('../src/config.php');

    $pk_cod_avaliacao = $_GET['pk_cod_avaliacao'];

    $sqlSelect = "SELECT * FROM avaliacao WHERE pk_cod_avaliacao=$pk_cod_avaliacao";

    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        $sqlDelete = "DELETE FROM avaliacao WHERE pk_cod_avaliacao=$pk_cod_avaliacao ";

        $resultDelete = $conexao->query($sqlDelete);
    }
}

header('Location: ../progressos.php');
