<?php

namespace App;

use App\Service\UserService;

class ListUserCommand
{
    public function __construct(private readonly UserService $service)
    {
    }
    public function support(string $name): bool
    {
        return $name === 'list';
    }

    public function execute(): void
    {
        $users = $this->service->listUsers();// вызов метода юзер сервис
        if (empty($users)) {
            echo "Все враги уничтожены.\n";
        } else {
            print_r($users);
        }
    }
}