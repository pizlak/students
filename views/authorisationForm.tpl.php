<?php

$errors = [] ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authorisation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/authorisationForm.css">
    
    <style>
        .container {
            width: 450px; /* Задайте требуемую ширину контейнера */
            height: 260px; /* Задайте требуемую высоту контейнера */
            background-color: #f1f1f1;
            position: fixed;
            top: 30%; /* Положение контейнера относительно верхней границы экрана */
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

        .form-control {
            width: 350px;
        }
    </style>
    <script
            src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $("#form").submit(function (event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    method: 'POST',
                    url: '/authorisation',
                    data: formData,
                    success: function (response) {
                        console.log('Success:', response)
                        if (response.error === false) {
                            window.location.href = "/redactor"
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
        </div>
    </div>
</nav>





<div class="error" id="error">
</div>




<div class="container">
    <div class="pagination justify-content-center">
        <form id="form" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Введите свою фамилию</label>
                <input class="form-control me-2" type="text" name="last_name" id="last_name" value="">
            </div>
            <div class="mb-3">
                <label for="mail">Введите свою электронную почту</label>
                <input class="form-control me-2" type="text" name="mail" id="mail" value="">
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Войти</button>
            </div>
        </form>
    </div>
    <div class="mb-3">
        <a href="/">Зарегистрироваться</a>
    </div>
</div>

</body>
</html>