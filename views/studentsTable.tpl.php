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
    <?php if($_COOKIE['mail']):?>
    <?php echo  '<br>'?>
    <div class="redact">
        <th><button><a href="../public/redactor.php">Редактировать свои данные</a></button></th>
    </div>
    <?php else:?>
    <?php echo '<br>'?>
    <div class="auth">
                <th><button><a href="../public/index.php">Войти</a></button> <button><a href="../public/index.php">Зарегистрироваться</a></button></th>
    </div>
    <?php endif?>
</div>
<?if($result->num_rows > 0):?>
<?echo '<br>'?>
<table>
    <tr>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Группа</th>
        <th>Сумма баллов ЕГЭ</th>
    </tr>
    <?while ($row = $result->fetch_assoc()):?>
        <tr>
            <td><?echo $row['First_Name']?></td>
            <td><?echo $row['Last_Name']?></td>
            <td><?echo $row['Group_Num']?></td>
            <td><?echo $row['Ege']?></td>
        </tr>
    <?endwhile?>
    <?else:?>
        <span style="color: red"><?echo "Нет данных для отображения"?></span>
    <?endif?>
</table>
</body>
</html>
