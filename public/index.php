<?php
require_once '../config/config.php';
if(isset($_COOKIE['mail'])){
    header('Location: redactor.php');
}
$errors = [];
$arr_gender = ['male' => 'Мужчина', 'female' => 'Женщина'];
$arr_local_town = ['local' => 'Местный', 'town' => 'Иногородний'];

include PATH . 'views/registrationForm.tpl.php';
