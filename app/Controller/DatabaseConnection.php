<?php

namespace app\Controller;

use mysqli;

class DatabaseConnection
{
    private static $dbObj;
    private mysqli $connection;

    private function __construct()
    {
        $host = 'localhost'; // сервер
        $dbname = 'students'; // имя таблицы
        $user = 'root'; // логин
        $pass = 'mysql'; //  пароль

        $this->connection = new mysqli($host, $user, $pass, $dbname); // подключение к БД
        if ($this->connection->connect_error) { // проверка подключения к БД
            die('Ошибка' . $this->connection->connect_error);
        }
    }
    public static function createNewConDbObj()
    {
        if(self::$dbObj === null){
            self::$dbObj = new self;
        }
        return self::$dbObj->connection;
    }
}