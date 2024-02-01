<?php

require_once '../config/config.php';

$controller = new \app\Controller\RegistrationController($_POST);
$controller->registration();







