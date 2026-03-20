<?php

use App\Service\UserService;
use App\Repository\JsonUserRepository;
use App\Repository\PostgresUserRepository;

require __DIR__ . '/vendor/autoload.php'; //вроде не сложно
require __DIR__ . '/db.php';

$config = parse_ini_file("./.env"); //чтение конфига (путь к файлу)
$dbSource = $config['DB_SOURCE'] ?? null;

if ($dbSource === 'postgres') {

    $repository = new PostgresUserRepository($pdo);

} else {
    $repository = new JsonUserRepository('users.json');
}
$service = new UserService($repository);

$command = $argv[1] ?? null; // сколько не читала в документации пхп ни чёрта не поняла, как это работает и уе8ала у гпт строку

$id = $argv[2] ?? null; // тоже из гпт, я ничо не поняла.

if ($command === 'list') {
    $users = $service->listUsers();// вызов метода юзер сервис
    if (empty($users)) {
        echo "Все враги уничтожены.\n";
    } else {
        print_r($users);
    }
}


if ($command === 'add') {

    $firstName = readline("Имя врага? ");
    $lastName = readline("Фамилия врага? ");
    $email = readline("email врага? ");

    $createUser = $service->createUser([
        'firstName' => $firstName ?: null,
        'lastName' => $lastName ?: null,
        'email' => $email ?: null,
    ]); // по аналогии из репозитори

    echo "Список врагов пополнен\n";
}

if ($command === 'delete' && $id) { // сервис
    $service->removeUser((int)$id);
    echo "Враг уничтожен\n";
}

// смотреть в документации - ничо не понятно. Что писать в этот файл спрашивала у гпт =(