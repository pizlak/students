<?php
require_once '../config/config.php';
global $conn;
$result = $conn->query('SELECT `First_Name`, `Last_Name`, `Group_Num`, `Ege` FROM `students_res` ORDER BY `Last_Name` ASC');
