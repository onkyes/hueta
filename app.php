<?php
use App\Repository\UserRepository;
use App\Service\UserService;

require __DIR__ . '/vendor/autoload.php';

$repository = new UserRepository();
$service = new UserService($repository);