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
        .container {
            width: 550px; /* Задайте требуемую ширину контейнера */
            height: 420px; /* Задайте требуемую высоту контейнера */
            background-color: #f1f1f1;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .navbar {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
    </style>
    <script
            src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>


</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Таблица со студентами</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/studentTable">
                        Показать список студентов</a>
                </li>
            </ul>
            <a class="d-flex btn btn-primary" href="/exitAccount">Выйти</a>
        </div>
    </div>
</nav>

<div id="error"></div>

<div class="container">
    <div class="pagination justify-content-center">
        <div class="mb-3">
            <h3> Здравствуйте <?= $user->getFirstName() . ' ' . $user->getLastName() ?> </h3>
        </div>
    </div>
    <div class="pagination justify-content-center">
        <div class="mb-3">
            <form id="editForm" method="POST" action="/redactor/new">
                <table>
                    <tr>
                        <th>
                            <span> Имя: </span>
                            <input class="form-control me-2" type="text" value="<?= $user->getFirstName() ?>"
                                   name="first_name">
                            <span>  Фамилия:</span>
                            <input class="form-control me-2" type="text" value="<?= $user->getLastName() ?>"
                                   name="last_name">
                            <span>  Пол:</span>
                            <input class="form-control me-2" type="text" value="<?= $user->getGender() ?>"
                                   name="gender">
                            <span>  Номер группы:</span>
                            <input class="form-control me-2" type="text" value="<?= $user->getGroupNum() ?>"
                                   name="gr_num">
                        </th>
                        <th>
                            <span>   Электронная почта:</span>
                            <input class="form-control me-2" type="text" value="<?= $user->getMail() ?>"
                                   name="mail">
                            <span>   Сумма баллов ЕГЭ:</span>
                            <input class="form-control me-2" type="text" value="<?= $user->getSumEge() ?>"
                                   name="sum_ege">
                            <span>   Дата рождения:</span>
                            <input class="form-control me-2" type="text" value="<?= $user->getYOBirth() ?>"
                                   name="y_o_b">
                            <span>  Местный/Иногородний:</span>
                            <input class="form-control me-2" type="text" value="<?= $user->getLocalTown() ?>"
                                   name="local_town">
                        </th>
                    </tr>
                </table>
                <button class="d-flex btn btn-primary" type="submit">Изменить данные</button>
            </form>
        </div>
    </div>
</div>

<h4>История изменений:</h4>
<div>
<?php if ($results): ?>
<table  class="table table-hover">
    <tr>
        <th>Дата и время изменений</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Пол</th>
        <th>Номер группы</th>
        <th>Электронная почта</th>
        <th>Сумма баллов ЕГЭ</th>
        <th>Дата рождения</th>
        <th>Местный/Иногородний</th>
    </tr>
    <?php foreach ($results as $result): ?>
    <tr>
        <td><?= $result['dataTime'] ?></td>
        <td><?= $result['FirstNameEdit']  ?></td>
        <td><?= $result['LastNameEdit']  ?></td>
        <td><?= $result['GenderEdit']  ?></td>
        <td><?= $result['GroupNumEdit']  ?></td>
        <td><?= $result['MailEdit']  ?></td>
        <td><?= $result['EgeEdit']  ?></td>
        <td><?= $result['YOBirthEdit']  ?></td>
        <td><?= $result['LocalTownEdit']  ?></td>
    </tr>
    <?php endforeach ?>
    <?php else: ?>
    <div style="color: #666666"><h5>История изменений отсутствует.</h5></div>
    <?php endif ?>
</table>
</div>
<script>
    $(document).ready(function () {
        $("#editForm").submit(function (event) {
            event.preventDefault();
            var formData = $(this).serialize()
            $.ajax({
                method: 'POST',
                url: '/redactor/new',
                data: formData,
                success: function (response) {
                    console.log('Success:', response);
                    if (response.error === false) {
                        window.location.href = '/redactor';
                    } else if (response.error === true) {
                        var errorList = $('<ul>');
                        $.each(response.message, function (key, value) {
                            var listItem = $('<p>').html(value);
                            errorList.append(listItem);
                        })
                        $("#error").html(errorList);
                    }
                }
            })
        })
    })

</script>