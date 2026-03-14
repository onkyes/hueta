<?php

namespace App\Repository;

use PDO;
use App\Repository\UserRepositoryInterface;

class PostgresUserRepository implements UserRepositoryInterface
{

    public function __construct(private PDO $pdo, private string $table = 'users')
    {}

    public function getAll(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table)->fetchAll();
    }

    public function add(array $user): void
    {
        $added = $this->pdo->prepare('INSERT INTO ' . $this->table . ' (id, first_name, last_name, email)' . ' VALUES(:id, :first_name, :last_name, :email)');
        $added->bindValue(':id', $user['id'], PDO::PARAM_INT);
        $added->bindValue(':first_name', $user['firstName'], PDO::PARAM_STR);
        $added->bindValue(':last_name', $user['lastName'], PDO::PARAM_STR);
        $added->bindValue(':email', $user['email'], PDO::PARAM_STR);
        $added->execute();
    } // было пролито много слёз

    public function delete(int $id): void
    {
        $dlt = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $dlt->bindValue(':id', $id, PDO::PARAM_INT);
        $dlt->execute();
    }
}