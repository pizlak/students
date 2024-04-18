<?php

require_once '../config/config.php';

$errors = [];
$arr_gender = ['male' => 'Мужчина', 'female' => 'Женщина'];
$arr_local_town = ['local' => 'Местный', 'town' => 'Иногородний'];

use app\Controller\StudentController;
use app\Controller\RegistrationController;

$route = [
    '/' => [
        'controller' => 'app\Controller\StudentController',
        'method' => 'viewRegistrationForm'
    ],
    '/redactor' => [     // форма редактирования данных
        'controller' => '\app\Controller\RegistrationController',
        'method' => 'viewEditForm'
    ],
    '/redactor/new' => [     // редактирование данных
        'controller' => '\app\Controller\RegistrationController',
        'method' => 'updateUser'
    ],
    '/authorisation' => [     //  автооризация
        'controller' => '\app\Controller\RegistrationController',
        'method' => 'authorisation'
    ],
    '/authorisationForm' => [     // форма  автооризации
        'controller' => '\app\Controller\RegistrationController',
        'method' => 'viewAuthorisationForm'
    ],
    '/registr' => [
        'controller' => '\app\Controller\RegistrationController',
        'method' => 'registration'
    ],
    '/studentTable' => [   //таблица со студентами
        'controller' => 'app\Controller\StudentController',
        'method' => 'viewStudentsTable'
    ],
    '/studentTable/search' => [ // поиск в таблие со студентами
        'controller' => 'app\Controller\StudentController',
        'method' => 'viewSearchStudents'
    ],

];

$url = $_SERVER['REQUEST_URI'];

if (isset($route[$url])) {
    $controller = new $route[$url]['controller'];
    $controller->{$route[$url]['method']}();
} else {
    echo '404 Page not found';
    die;
}
/*
include PATH . 'views/registrationForm.tpl.php';*/
