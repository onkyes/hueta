<?php
use App\Repository\UserRepository;
use App\Service\UserService;

require __DIR__ . '/vendor/autoload.php'; //вроде не сложно

$config = parse_ini_file("./.env"); //чтение конфига (путь к файлу)
$dbSource = $config['DB_SOURCE'] ?? null;
$repository = new UserRepository($dbSource);
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
    $user = $service->createUser(); // по аналогии из репозитори
    $repository->add($user);
    echo "Список врагов пополнен\n";
}
if ($command === 'delete' && $id) { // сервис
    $service->removeUser((int)$id);
    echo "Враг уничтожен\n";
}

// смотреть в документации - ничо не понятно. Что писать в этот файл спрашивала у гпт =(