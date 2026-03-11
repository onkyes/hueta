<?php

namespace App\Repository;

use App\Repository\UserRepositoryInterface;

class JsonUserRepository implements UserRepositoryInterface
{
    public function __construct(private string $filePath) {}


    public function getAll(): array
    {
        $result = file_get_contents($this->filePath);
        if ($result === false) {
            return [];
        }
        $users = json_decode($result, true);

        if (!is_array($users)) {
            return [];
        }
        return $users;
    }

    public function add(array $user): void
    {
        $users = $this->getAll();
        $users[$user['id']] = $user;
        file_put_contents($this->filePath, json_encode($users, JSON_PRETTY_PRINT));
    }

    public function delete(int $id): void
    {
        $users = $this->getAll();

        unset($users[$id]);

        file_put_contents($this->filePath, json_encode($users, JSON_PRETTY_PRINT));
    }
}