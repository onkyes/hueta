<?php

namespace App\Service;


// генерация id
// генерация имени
// генерация email
// вызвать методы репозитори
use App\Repository\UserRepository;

// предложил шторм хз чо это

class UserService
{
    //массив имён = свойство класса
    private array $randFirstNames = ['Гаврила', 'Петручо', 'Андрей', 'Полу', 'Лина', 'Бабка', 'Дура'];
    private array $randLastNames = ['Дуболомов', 'Скамерок', 'Санстрайк', 'Покер', 'Однопульный', 'Калоед', 'Покер'];

    private UserRepository $repository;
    public function __construct(UserRepository $repository)
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

// $account - массив данных, если пользователь сам придумает имя
