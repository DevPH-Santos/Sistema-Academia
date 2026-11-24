<?php

if (!defined('APP_RUNNING')) {
    http_response_code(403);
    exit('Acesso negado.');
}

/** Load simple KEY=value settings without requiring a third-party package. */
function loadAppEnvironment(string $path): array
{
    if (!is_file($path) || !is_readable($path)) {
        throw new RuntimeException('Arquivo de configuração .env não encontrado ou sem permissão de leitura.');
    }

    $values = [];
    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }

        $separator = strpos($line, '=');
        if ($separator === false) {
            continue;
        }

        $key = trim(substr($line, 0, $separator));
        $value = trim(substr($line, $separator + 1));
        if ($key === '') {
            continue;
        }

        if (strlen($value) >= 2 && (($value[0] === '"' && $value[-1] === '"') || ($value[0] === "'" && $value[-1] === "'"))) {
            $value = substr($value, 1, -1);
        }
        $values[$key] = $value;
    }

    return $values;
}

$env = loadAppEnvironment(dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env');
$dbHost = getenv('DB_HOST') ?: ($env['DB_HOST'] ?? '');
$dbUsername = getenv('DB_USERNAME') ?: ($env['DB_USERNAME'] ?? '');
$dbPassword = getenv('DB_PASSWORD') ?: ($env['DB_PASSWORD'] ?? '');
$dbName = getenv('DB_DATABASE') ?: ($env['DB_DATABASE'] ?? '');

if ($dbHost === '' || $dbUsername === '' || $dbName === '') {
    throw new RuntimeException('Configuração do banco incompleta. Confira DB_HOST, DB_USERNAME e DB_DATABASE no .env.');
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    $conexao->set_charset('utf8mb4');
} catch (mysqli_sql_exception $exception) {
    error_log('Falha na conexão MySQL: ' . $exception->getMessage());
    http_response_code(500);
    exit('Não foi possível conectar ao banco de dados. Confira as configurações no .env.');
}

