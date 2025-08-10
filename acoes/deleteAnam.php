<?php
if (!empty($_GET['id'])) {

    define('APP_RUNNING', true);
    require_once('../src/config.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM anamnese WHERE id=$id";

    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        $sqlDelete = "DELETE FROM anamnese WHERE id=$id ";

        $resultDelete = $conexao->query($sqlDelete);
    }
}

header('Location: ../anamnese.php');
