<?php
global $arr_gender,  $arr_local_town;
require_once '../config/config.php'?>

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
<?php foreach ($errors as $error):?>
    <span style="color: red" ><?=$error ?></span>
<?php endforeach?>
<form method="POST" action="/registr.php">
    <table>
        <tr>
            <th><label for="first_name">Имя:</label></th>
            <th><input type="text" name="first_name" id="first_name" ></th>
        </tr>
        <tr>
            <th><label for="last_name">Фамилия:</label></th>
            <th><input type="text" name="last_name" id="last_name"></th>
        </tr>
        <tr>
            <th><label for="gender">Выберите Ваш пол:</label></th>
            <th> <select name="gender" id="gender">
                    <?php foreach ($arr_gender as $key_gen => $value_gen):?>
                        <?= "<option value=" . $value_gen ."> $value_gen </option>"?>
                    <?php endforeach?>
                </select></th>
        </tr>
        <tr>
            <th><label for="gr_num">Номер группы:</label></th>
            <th><input type="text" name="gr_num" id="gr_num"></th>
        </tr>
        <tr>
            <th><label for="mail">Е-Майл:</label></th>
            <th><input type="text" name="mail" id="mail"></th>
        </tr>
        <tr>
            <th><label for="sum_ege">Сумма баллов ЕГЭ:</label></th>
            <th><input type="text" name="sum_ege" id="sum_ege"></th>
        </tr>
        <tr>
            <th><label for="y_o_b">Год рождения</label></th>
            <th><input type="date" id="y_o_b" name="y_o_b" min="1950-01-01" max="2005-12-31" required></th>
        </tr>
        <tr>
            <th><label for="local_town">Местный/Иногородний:</label></th>
            <th>
                <select name="local_town" id="local_town">
                    <?php foreach ($arr_local_town as $key_lt => $value_lt):?>
                        <?= "<option value=" . $value_lt . ">$value_lt</option>"?>
                    <?php endforeach?>
                </select>
            </th>
        </tr>
        <tr>
            <th><button type="submit">Зарегистрироваться</button></th>
        </tr>
    </table>
</form>
</body>
</html>
