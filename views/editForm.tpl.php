<?php
/** @var \app\Model\UserModel $user */

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div>
    <button><a href="../public/studentTable.php">Показать список студентов</a></button>
</div>
<form method="POST" action="/redactor.php">
    <table>
        <tr>
            <th><input type="text" value="<?= $user->getFirstName() ?>" name="first_name" ></th>
            <th><input type="text" value="<?= $user->getLastName()?>" name="last_name"></th>
        </tr>
        <tr>
            <th><input type="text" value="<?= $user->getGender() ?>" name="gender"></th>
            <th><input type="text" value="<?= $user->getGroupNum() ?>" name="gr_num"></th>
        </tr>
        <tr>
            <th><input type="text" value="<?= $user->getMail() ?>" name="mail"></th>
            <th><input type="text" value="<?= $user->getSumEge() ?>" name="sum_ege"></th>
        </tr>
        <tr>
            <th><input type="text" value="<?= $user->getYOBirth() ?>" name="y_o_b"></th>
            <th><input type="text" value="<?= $user->getLocalTown() ?>" name="local_town"></th>
        </tr>
        <tr><th><button type="submit">Изменить данные</button></th></tr>
    </table>
</form>
</body>
</html>