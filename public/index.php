<?php
require_once '../config/config.php';

use app\Controller\StudentController;
use app\Controller\RegistrationController;

$errors = [];
$arr_gender = ['male' => 'Мужчина', 'female' => 'Женщина'];
$arr_local_town = ['local' => 'Местный', 'town' => 'Иногородний'];



$route = [
    '/' => [
        'controller' => StudentController::class,
        'method' => 'viewRegistrationForm'
    ],
    '/redactor' => [     // форма редактирования данных
        'controller' => RegistrationController::class,
        'method' => 'viewEditForm'
    ],
    '/redactor/new' => [     // редактирование данных
        'controller' => RegistrationController::class,
        'method' => 'updateUser'
    ],
    '/authorisation' => [     //  автооризация
        'controller' => RegistrationController::class,
        'method' => 'authorisation'
    ],
    '/exitAccount'  => [     // выход из аккаунта из личного кабинета
        'controller' => RegistrationController::class,
        'method' => 'exitAccount'
    ],
    '/authorisationForm' => [     // форма  автооризации
        'controller' => RegistrationController::class,
        'method' => 'viewAuthorisationForm'
    ],
    '/registr' => [     //регистрауия
        'controller' => RegistrationController::class,
        'method' => 'registration'
    ],
    '/studentTable' => [   //таблица со студентами
        'controller' => StudentController::class,
        'method' => 'viewStudentsTable'
    ],
    '/studentTable/search' => [ // поиск в таблие со студентами
        'controller' => StudentController::class,
        'method' => 'viewSearchStudents'
    ],


];

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

if (isset($route[$url])) {
    $controller = new $route[$url]['controller'];
    $controller->{$route[$url]['method']}();
} else {
    echo '<h1>404 Page not found</h1>';
    die;
}
