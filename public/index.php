<?php

use App\Service\UserService;
use App\Repository\PostgresUserRepository;
use App\Repository\JsonUserRepository;

require __DIR__ . '/../db.php';
require __DIR__ . '/../vendor/autoload.php';



if ($dbSource === 'postgres') {
    $repository = new PostgresUserRepository($pdo);
} else {
    $repository = new JsonUserRepository($filePath);
}

$service = new UserService($repository);

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/users' && $method === 'GET') {
    $us = $service->listUsers();
    header('Content-Type: application/json');
    echo json_encode($us, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
}

if ($uri === '/users' && $method === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $service->createUser($data);
    header('Content-Type: application/json');
    echo json_encode('Список врагов пополнен', JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
}

if (str_starts_with($uri, '/users/') && $method === 'DELETE') {
    $id = str_replace('/users/', '', $uri);
    $service->removeUser($id);
    header('Content-Type: application/json');
    echo json_encode('Враг устранён', JSON_THROW_ON_ERROR);
}


