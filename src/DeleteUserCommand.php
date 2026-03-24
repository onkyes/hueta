<?php

namespace App;

use App\Service\UserService;

class DeleteUserCommand
{
    public function __construct(private UserService $service)
    {
    }
    public function support(string $name): bool
    {
        return $name === 'delete';
    }

    public function execute()
    {
        $this->service->removeUser((int) ($argv[2] ?? null));
        echo "Враг уничтожен\n";

    }
}