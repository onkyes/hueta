<?php

use App\RepositoryFactory;
use App\Service\UserService;

require __DIR__ . '/vendor/autoload.php'; //вроде не сложно

$factory = new RepositoryFactory();
$repository = $factory();
$service = new UserService($repository);

$command = $argv[1] ?? null;
$id = $argv[2] ?? null;

$strategies = [];
$strategies[] = new \App\AddUserCommand($service);
$strategies[] = new \App\DeleteUserCommand($service);
$strategies[] = new \App\ListUserCommand($service);

foreach ($strategies as $strategy) {
    if ($strategy->support($command)) {
        $strategy->execute();
    }
}

