<?php

namespace App\Repository;

interface UserRepositoryInterface
{
    public function getAll(): array;
    public function add(array $user): void;

    public function delete(int $id): void;
}