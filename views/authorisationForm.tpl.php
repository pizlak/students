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
<form method="post" action="/authorisation" >
    <table>
        <tr>
            <th><label for="last_name">Введите свою фамилию</label></th>
            <th><input type="text" name="last_name" id="last_name" value="" ></th>
        </tr>
        <tr>
            <th><label for="mail">Введите свою электронную почту</label></th>
            <th><input type="text" name="mail" id="mail" value="" ></th>
        </tr>
        <tr>
            <th><button type="submit">Войти</button></th>
        </tr>
    </table>
</form>
</body>
</html>