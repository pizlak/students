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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .errors{  <!-- ПОНЯТНО ЧТО ЭТО ДОЛЖНО БЫТЬ В ФАЙЛЕ CSS, НО ЧТО-ТО У МЕНЯ ПОКА НЕ ХОЧЕТ ОН РАБОТАТЬ -->
            color: red;
            font-size: 12px;
        }
    </style>

</head>
<body>
<div>
    <button><a href="../public/studentTable.php">Показать список студентов</a></button> <br>
    <h3> Здравствуйте  <?= $user->getFirstName() . ' ' . $user->getLastName() ?> </h3>
</div>
<form method="POST" action="/redactor.php">
    <table>
        <tr>
            <th>Имя:</th>
            <th><input type="text" value="<?= $user->getFirstName() ?>" name="first_name"> </th>
        </tr>
        <tr><th></th><th><span class="errors"><?=$errors['first_name'] ?? '' ?></span></th></tr>
        <tr>
            <th>Фамилия:</th>
            <th><input type="text" value="<?= $user->getLastName() ?>" name="last_name"></th>
        </tr>
        <tr><th></th><th><span class="errors"><?=$errors['last_name'] ?? '' ?></span></th></tr>
        <tr>
        <tr>
            <th>Пол:</th>
            <th><input type="text" value="<?= $user->getGender() ?>" name="gender"></th>
        </tr>
        <tr><th></th><th><span class="errors"><?=$errors['gender'] ?? '' ?></span></th></tr>
        <tr>
        <tr>
            <th>Номер группы:</th>
            <th><input type="text" value="<?= $user->getGroupNum() ?>" name="gr_num"></th>
        </tr>
        <tr><th></th><th><span class="errors"><?=$errors['gr_num'] ?? '' ?></span></th></tr>
        <tr>
        <tr>
            <th>Электронная почта:</th>
            <th><input type="text" value="<?= $user->getMail() ?>" name="mail"></th>
        </tr>
        <tr><th></th><th><span class="errors"><?=$errors['mail'] ?? '' ?></span></th></tr>
        <tr>
        <tr>
            <th>Сумма баллов ЕГЭ:</th>
            <th><input type="text" value="<?= $user->getSumEge() ?>" name="sum_ege"></th>
        </tr>
        <tr><th></th><th><span class="errors"><?=$errors['sum_ege'] ?? '' ?></span></th></tr>
        <tr>
        <tr>
            <th>Дата рождения:</th>
            <th><input type="text" value="<?= $user->getYOBirth() ?>" name="y_o_b"></th>
        </tr>
        <tr><th></th><th><span class="errors"><?=$errors['y_o_b'] ?? '' ?></span></th></tr>
        <tr>
        <tr>
            <th>Местный/Иногородний:</th>
            <th><input type="text" value="<?= $user->getLocalTown() ?>" name="local_town"></th>
        </tr>
        <tr><th></th><th><span class="errors"><?=$errors['local_town'] ?? '' ?></span></th></tr>
        <tr>
        <tr>
            <th>
                <button type="submit">Изменить данные</button>
            </th>
        </tr>
    </table>
</form>
</body>
</html>