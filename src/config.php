<?php

if (!defined('APP_RUNNING')) {
    die("Acesso negado.");
}

// Definindo as credenciais do banco de dados
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = ''; //admin
$dbName = 'academia';

// Criando a conexão com o banco de dados
$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Verificando se houve erro na conexão
/*if($conexao->connect_errno){
        echo "Erro: " . $conexao->connect_error; // Mostrando a mensagem de erro
    } else {
        echo "Conexão efetuada com sucesso";
    }*/

?>