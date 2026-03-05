<?php

namespace App\Repository;


// прочитать json файл
// сохранить json файл
// удалить пользователя
class UserRepository
{

    private const JSON_DB = __DIR__ . '/../../users.json';
    public function getAll(): array
    {
        $result = file_get_contents(self::JSON_DB);
        if ($result === false) { //проверка на чтение
            return [];
        }
        $users = json_decode($result, true);
        if (!is_array($users)) { //проверка на массив
            return [];
        }

        return $users;
    }

    public function add(array $user): void
    {
        $users = $this->getAll(); // получаем массив
        $users[] = $user; // добавляем пользователя
        file_put_contents(self::JSON_DB, json_encode($users, JSON_PRETTY_PRINT)); // перезаписываем файл
    }

    public function delete(int $id): void
    {
        $users = $this->getAll();
        $filter = [];
        foreach ($users as $user) {
            if ($user['id'] !== $id) {
                $filter[] = $user;
            }
        }
        file_put_contents(self::JSON_DB, json_encode($filter, JSON_PRETTY_PRINT));
    }


}


//$user - новый пользователь/пользователь
//$filter - новый массив при удалении
//$result - переменная, куда считан json
//$users - массив