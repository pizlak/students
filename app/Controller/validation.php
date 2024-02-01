<?php
function clearData($val){
    $val = trim($val);
    $val = stripslashes($val);
    $val = strip_tags($val);
    $val = htmlspecialchars($val);
    return $val;
}

$first_name = clearData($_POST['first_name']);
$last_name = clearData($_POST['last_name']);
$gender = clearData($_POST['gender']);
$gr_num = clearData($_POST['gr_num']);
$mail = clearData($_POST['mail']);
$sum_ege = clearData($_POST['sum_ege']);
$y_o_b = clearData($_POST['y_o_b']);
$local_town = clearData($_POST['local_town']);

$pattern_name = '/^.*[^А-яЁё].*$/';
$err = [];
$flag = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!preg_match($pattern_name, $first_name)){
        $err['first_name'] = '<small style="color: red" class="text-danger" >Здесь только русские символы.</small>';
        $flag = 1;
    }
}