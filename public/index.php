<?php

require_once '../config/config.php';
if (isset($_COOKIE['mail'])) {
    header('Location: /redactor');
}
$errors = [];
$arr_gender = ['male' => 'Мужчина', 'female' => 'Женщина'];
$arr_local_town = ['local' => 'Местный', 'town' => 'Иногородний'];

use app\Controller\StudentController;
use app\Controller\RegistrationController;

$route = [
    '/studentTable' => [
        'controller' => 'app\Controller\StudentController',
        'method' => 'viewStudentsTable',
        'methodSearch' => 'viewSearchStudents'
    ],
    '/redactor' => [
        'controller' => 'app\Controller\RegistrationController',
        'method' => 'viewEditForm',
        'methodUpdate' => 'updateUser'
    ],
    '/registr' => [
        'controller' => '\app\Controller\RegistrationController',
        'method' => 'registration'
    ]
];
$urlRegistration = '/registr';
$urlRedactor = '/redactor';
$urlStudentsTable = '/studentTable';
/*
if (isset($route[$urlRedactor])) {
    $controller = new $route[$urlRedactor]['controller']($_POST);
    if (!empty($_POST)) {
        $controller->{$route[$urlRedactor]['methodUpdate']}();
    } else {
        $controller->{$route[$urlRedactor]['method']}();
}}

if (isset($route[$urlRegistration])) {
    if (!empty($_POST)) {
        $controller = new $route[$urlRegistration]['controller']($_POST);
        $controller->{$route[$urlRegistration]['method']}();
    }
}*/

if (isset($route[$urlStudentsTable])) {
    $controller = new $route[$urlStudentsTable]['controller'];
    if (!empty($_POST['search'])) {
        $controller->{$route[$urlStudentsTable]['methodSearch']}();
    } else {
        $controller->{$route[$urlStudentsTable]['method']}();
    }
} else {
    echo '404 Page not found';
    die;
}
/*
include PATH . 'views/registrationForm.tpl.php';*/
