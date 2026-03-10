<?php

namespace App\Repository;




// прочитать json файл
// сохранить json файл
// удалить пользователя
class UserRepository
{

    public function __construct(private string $dbSource)
    {}



    public function getAll(): array
    {
        if ($this->dbSource === 'json' ) {
            $result = file_get_contents($this->dbSource); // считывает содержимое файла в строку

            if ($result === false) { //проверка на чтение
                return [];
            }

            $users = json_decode($result, true, 512, JSON_THROW_ON_ERROR);

            if (!is_array($users)) { //проверка на массив
                return [];
            }

            return $users;

        } else {
            // запрос к постгрису
        }


    }

    public function add(array $user): void
    {
        $users = $this->getAll(); // получаем массив
        $users[$user['id']] = $user; // добавляем пользователя

        if ($this->dbSource === 'json') {
            file_put_contents(self::JSON_DB, json_encode($users, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT)); // перезаписываем файл
        } else {
            // запрос к бд
        }
    }

    public function delete(int $id): void
    {
        $users = $this->getAll();

        unset($users[$id]);
        if ($this->dbSource === 'json') {
            file_put_contents(self::JSON_DB, json_encode($users, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
        } else {
            // запрос к бд
        }
    }


}


//$user - новый пользователь/пользователь
//$filter - новый массив при удалении
//$result - переменная, куда считан json
//$users - массив