<?php

require_once '../config/config.php';
if (!isset($_COOKIE['mail'])) {
    header('Location: index.php');
}/*
$controller = new \app\Controller\RegistrationController($_POST);
if (!empty($_POST)) {
    $controller->updateUser();
} else {
    $controller->viewEditForm();
}*/

