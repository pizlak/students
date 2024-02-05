<?php

$host = 'localhost'; // сервер
$dbname = 'students'; // имя таблицы
$user = 'root'; // логин
$pass = 'mysql'; //  пароль
$conn = new mysqli($host, $user, $pass, $dbname); // подключение к БД
if ($conn->connect_error) { // проверка подключения к БД
    die('Ошибка' . $conn->connect_error);
}
define('PATH', dirname(__DIR__) . '/');  // константа диррективы
spl_autoload_register(function ($class) { // автозагрузка
    $path = PATH . $class . '.php';
    if (file_exists($path)) {
        include $path;
    }
});
