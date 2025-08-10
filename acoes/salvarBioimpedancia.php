<?php

define('APP_RUNNING', true);
require_once('../src/config.php');

// Verifica se o formulário de avaliação foi enviado
if (isset($_POST['submit_bioimpedancia'])) {

    // Captura os dados do formulário
    $data = $_POST['data']; // Supondo que você tenha um campo de entrada para a data no formato dd/mm/yyyy
    $peso = str_replace(',', '.', $_POST['peso']); // Troca vírgula por ponto
    $massa_magra = str_replace(',', '.', $_POST['massa_magra']); // Troca vírgula por ponto
    $massa_gorda = str_replace(',', '.', $_POST['massa_gorda']); // Troca vírgula por ponto
    $gordura_corporal = str_replace(',', '.', $_POST['gordura_corporal']); // Troca vírgula por ponto
    $nome = $_POST['nome']; // Captura o nome

    // Insere os dados na tabela de avaliações
    $result = mysqli_query($conexao, "INSERT INTO Bioimpedancia(data, peso, massa_magra, massa_gorda, gordura_corporal, nome) 
    VALUES ('$data', '$peso', '$massa_magra', '$massa_gorda', '$gordura_corporal', '$nome')");
}

// Consulta para obter as avaliações
$sql = "SELECT * FROM Bioimpedancia ORDER BY data DESC";
$result = $conexao->query($sql);

header('Location: ../bioimpedancia.php');
