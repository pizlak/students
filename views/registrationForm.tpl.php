<?php

require_once '../config/config.php';
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
    <link rel="stylesheet" href="../public/styles.css">
    <style>
        .container {
            width: 550px; /* Задайте требуемую ширину контейнера */
            height: 420px; /* Задайте требуемую высоту контейнера */
            background-color: #f1f1f1;
            position: fixed;
            top: 18%; /* Положение контейнера относительно верхней границы экрана */
            left: 32%; /* Положение контейнера относительно левой границы экрана */
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .error{
            color: red;
        }

        .navbar {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
    </style>
    <script
            src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#registrForm').submit(function (event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    method: 'POST',
                    url: '/registr',
                    data: formData,
                    success: function (response){
                        console.log('Success:', response)
                        if (response.error === false){
                            window.location.href = "/redactor"
                        } else if (response.error === true) {
                            var errorList = $('<ul>');
                            $.each(response.message, function (key, value){
                                var listItem = $('<p>').html(value);
                                errorList.append(listItem);
                                $("#error").html(errorList);
                            })
                        }
                    }
                })
            })
        })
    </script>
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
                    <a class="nav-link active" aria-current="page" href="/authorisationForm">
                        Авторизоваться</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/studentTable">
                        Показать список студентов</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="error" id="error"></div>

<div class="container">
    <div class="pagination justify-content-center">
        <div class="mb-3">
            <form id="registrForm" method="POST" action="/registr">

                <table>
                    <tr>
                        <th>
                            <div class="mb-3">
                                <label class="form-label" for="first_name">Имя:</label>
                                <input class="form-control me-2" type="text" name="first_name" id="first_name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="last_name">Фамилия:</label>
                                <input class="form-control me-2" type="text" name="last_name" id="last_name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="gender">Выберите Ваш пол:</label>
                                <select class="form-control me-2" name="gender" id="gender">
                                    <option value="Мужчина">Мужчина</option>
                                    <option value="Женщина">Женщина</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="gr_num">Номер группы:</label>
                                <input class="form-control me-2" type="text" name="gr_num" id="gr_num">
                            </div>
                        </th>
                        <th>
                            <div class="mb-3">
                                <label class="form-label" for="mail">Е-Майл:</label>
                                <input class="form-control me-2" type="text" name="mail" id="mail">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="sum_ege">Сумма баллов ЕГЭ:</label>
                                <input class="form-control me-2" type="text" name="sum_ege" id="sum_ege">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="y_o_b">Год рождения</label>
                                <input class="form-control me-2" type="date" id="y_o_b" name="y_o_b" min="1950-01-01"
                                       max="2005-12-31">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="local_town">Местный/Иногородний:</label>
                                <select class="form-control me-2" name="local_town" id="local_town">
                                    <option value="Местный">Местный</option>
                                    <option value="Иногородний">Иногородний</option>
                                </select>
                            </div>
                        </th>
                    </tr>
                </table>
                <div class="mb-3">
                    <th>
                        <button class="btn btn-primary" type="submit">Зарегистрироваться</button>
                    </th>
                </div>

            </form>
        </div>
    </div>
</div>
</body>
</html>
