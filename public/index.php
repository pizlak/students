<?php

require_once '../config/config.php';
if (isset($_COOKIE['mail'])) {
    header('Location: redactor.php');
}
$errors = [];
$arr_gender = ['male' => 'Мужчина', 'female' => 'Женщина'];
$arr_local_town = ['local' => 'Местный', 'town' => 'Иногородний'];

/*route = [
    '/public/studentTable.php' => ['controller' => 'StudentController', 'method' => 'viewStudentsTable'],
    '/public/redactor.php' => ['controller' => 'RegistrationController', 'method' => 'viewEditForm']
];

$url = $_SERVER['REQUEST_URI'];

if (isset($route[$url])){
$controller = new $route[$url]['controller'];
$controller->$route[$url]['method']();
} else {
    echo '404 Page not found';
    die;
}*/

include PATH . 'views/registrationForm.tpl.php';
