<?php

namespace App\Service;


use App\Repository\UserRepositoryInterface;

// предложил шторм хз чо это

class UserService
{
    //массив имён = свойство класса
    private array $randFirstNames = ['Gavrila', 'Faggot', 'Andrey', 'Polu', 'Lina', 'Babka', 'Dura'];
    private array $randLastNames = ['Dubolomov', 'Skamerok', 'SunStrike', 'Poker', 'Odnopulniy', 'Kaloed', 'WetPussy'];

    private UserRepositoryInterface $repository;
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function createUser(array $account = []): array // генерация всей хуйни =(
    {
        // получить users из репозитори
        $users = $this->repository->getAll();

        //нагенерить id || было сложно написала 23424 раз по итогу попросила чат гпт, потому что https://www.youtube.com/shorts/s2r1v7f-btY
        if (empty($users)) {
            $id = 1;
        } else {
            $lastId = end($users);
            $id = $lastId['id'] + 1;
        }


        // нагенерить/взять имя, фамилию
        $firstName = $account['firstName'] ?? $this->randFirstNames[array_rand($this->randFirstNames)];
        $lastName = $account['lastName'] ?? $this->randLastNames[array_rand($this->randLastNames)];

        //нагенерить/взять имейл
        $email = $account['email'] ?? strtolower($firstName . '.' . $lastName) . '@gmail.com';

        $user = [
            'id' => $id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email
        ];

    $this->repository->add($user);

    return $user;
    }

    public function listUsers(): array
    {
        return $this->repository->getAll();
    }

    public function removeUser(int $id): void //
    {
        $this->repository->delete($id);
    }
}


