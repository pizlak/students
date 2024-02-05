<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<div class="header">
    <?php if(isset($_COOKIE['mail'])):?>
    <?=  '<br>'?>
    <div class="redact">
        <th><button><a href="../public/redactor.php">Редактировать свои данные</a></button></th>
    </div>
    <?php else:?>
    <?= '<br>'?>
    <div class="auth">
                <th><button><a href="../public/index.php">Войти</a></button> <button><a href="../public/index.php">Зарегистрироваться</a></button></th>
    </div>
    <?php endif?>
</div>
<?php if($result->num_rows > 0):?>
<?= '<br>'?>
<table>
    <tr>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Группа</th>
        <th>Сумма баллов ЕГЭ</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()):?>
        <tr>
            <td><?= $row['First_Name']?></td>
            <td><?= $row['Last_Name']?></td>
            <td><?= $row['Group_Num']?></td>
            <td><?= $row['Ege']?></td>
        </tr>
    <?php endwhile?>
    <?php else:?>
        <span style="color: red"><?= "Нет данных для отображения"?></span>
    <?php endif?>
</table>
</body>
</html>
