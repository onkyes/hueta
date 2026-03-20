<?php

$config = parse_ini_file(__DIR__ . '/.env'); //чтение конфига (путь к файлу)
$dbSource = $config['DB_SOURCE'] ?? null;

if ($dbSource === 'postgres') {
    $dsn = "pgsql:host=127.0.0.1;port=5432;dbname=postgres;user=postgres;password=";
    $pdo = new PDO($dsn);
} else {
    $filePath = __DIR__ . '/users.json';
}