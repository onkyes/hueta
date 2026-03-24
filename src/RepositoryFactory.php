<?php

namespace App;

use App\Repository\JsonUserRepository;
use App\Repository\PostgresUserRepository;
use App\Repository\UserRepositoryInterface;


class RepositoryFactory
{

    public function __invoke(): UserRepositoryInterface
    {
        $dbSource = $_ENV['DB_SOURCE'] ?? null;

        if ($dbSource === 'postgres') {
            $dsn = "pgsql:host=" . $_ENV['DATABASE_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=postgres;user=postgres;password=";

            $pdo = new \PDO($dsn);
        } else {
            $filePath = __DIR__ . '/../users.json';
        }

        if ($dbSource === 'postgres') {

            $repository = new PostgresUserRepository($pdo);

        } else {
            $repository = new JsonUserRepository($filePath);
        }
        return $repository;
    }


}