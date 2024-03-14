<?php

require_once '../config/config.php';
$errors = [];
$arr_gender = ['male' => 'Мужчина', 'female' => 'Женщина'];
$arr_local_town = ['local' => 'Местный', 'town' => 'Иногородний'];
$controller = new \app\Controller\RegistrationController($_POST);
$controller->registration();
var_dump($_SERVER['REQUEST_URI']);





