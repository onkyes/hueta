<?php

namespace App;

use App\Service\UserService;

class AddUserCommand
{
    public function __construct(private readonly UserService $service)
    {
    }

    public function support(string $name): bool
    {
        return $name === 'add';
    }

    public function execute()
    {
        $firstName = readline("Имя врага? ");
        $lastName = readline("Фамилия врага? ");
        $email = readline("email врага? ");

        $createUser = $this->service->createUser([
            'firstName' => $firstName ?: null,
            'lastName' => $lastName ?: null,
            'email' => $email ?: null,
        ]); // по аналогии из репозитори
        echo "Список врагов пополнен\n";
    }
}