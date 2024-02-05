<?php

require_once '../config/config.php';


if (isset($_POST['search'])){
    $controller = new \app\Controller\StudentController();
    $controller->viewStudentsTable();
} else {
    $controller = new \app\Controller\StudentController();
    $controller->viewStudentsTable();
}