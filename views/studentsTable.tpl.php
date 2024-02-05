<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Students Table</title>
    <link rel="stylesheet" href="/public/css/studentsTable.css">
</head>
<body>
<div class="body">
    <div class="search"><form action="/public/studentTable.php" method="post">
            <input type="text" name="search" placeholder="Введите запрос">
            <input type="submit" value="Поиск">
        </form></div>
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
<table class="table">
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
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
