<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Students Table</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .container {
            width: 100%;
        }
        .navbar {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Таблица со студентами</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if(isset($_COOKIE['mail'])): ?>
                <li class="nav-item"> <a class="nav-link" href="/redactor">Редактировать свои данные</a> </li>
                <?php else: ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Войти в личный кабинет
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/authorisationForm">Авторизоваться</a></li>
                        <li><a class="dropdown-item" href="/">Зарегистрироваться</a></li>
                    </ul>
                </li>
                <?php endif ?>
            </ul>
            <form class="d-flex" role="search" action="/studentTable/search?sort=First_Name&sort_type=<?=$sortTypeLink?>&page=<?=$currentPage?>" method="get">
                <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<body>

<?php if(is_object($result)): ?>
<?php if ($result->num_rows > 0): ?>
<?= '<br>' ?>
<div class="container">
<table class="table table-hover">
    <tr class="table table-success table-striped">
        <th><a href="<?=$baseSortUrl?>?sort=First_Name&sort_type=<?=$sortTypeLink?>&page=<?=$currentPage?>">Имя</a></th>
        <th><a href="<?=$baseSortUrl?>?sort=Last_Name&sort_type=<?=$sortTypeLink?>&page=<?=$currentPage?>">Фамилия</a></th>
        <th><a href="<?=$baseSortUrl?>?sort=Group_Num&sort_type=<?=$sortTypeLink?>&page=<?=$currentPage?>">Группа</a></th>
        <th><a href="<?=$baseSortUrl?>?sort=Y_O_Birth&sort_type=<?=$sortTypeLink?>&page=<?=$currentPage?>">Сумма баллов ЕГЭ</a></th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td class="blockquote"><?= $row['First_Name'] ?></td>
            <td class="blockquote"><?= $row['Last_Name'] ?></td>
            <td class="lead"><?= $row['Group_Num'] ?></td>
            <td class="lead"><?= $row['Ege'] ?></td>
        </tr>
    <?php
    endwhile ?>
    <?php
    else: ?>
        <span style="color: red"><?= "Нет данных для отображения" ?></span>
    <?php
    endif ?>
</table>
<?php else: ?>
    <table class="table table-hover">
    <tr class="table table-success table-striped">
        <th><a href="<?=$baseSortUrl?>?sort=First_Name&sort_type=<?=$sortTypeLink?>&page=<?=$currentPage?>&search=<?=$search?>">Имя</a></th>
        <th><a href="<?=$baseSortUrl?>?sort=Last_Name&sort_type=<?=$sortTypeLink?>&page=<?=$currentPage?>&search=<?=$search?>">Фамилия</a></th>
        <th><a href="<?=$baseSortUrl?>?sort=Group_Num&sort_type=<?=$sortTypeLink?>&page=<?=$currentPage?>&search=<?=$search?>">Группа</a></th>
        <th><a href="<?=$baseSortUrl?>?sort=Y_O_Birth&sort_type=<?=$sortTypeLink?>&page=<?=$currentPage?>&search=<?=$search?>">Сумма баллов ЕГЭ</a></th>
    </tr>
    <?php foreach ($result as $results): ?>
        <tr>
            <td class="blockquote"><?= $results['First_Name'] ?></td>
            <td class="blockquote"><?= $results['Last_Name'] ?></td>
            <td class="lead"><?= $results['Group_Num'] ?></td>
            <td class="lead"><?= $results['Ege'] ?></td>
        </tr>
        <?php endforeach ?>
        </table>
<?php endif ?>

<div class="pagination justify-content-center">
<?php for($page = 1; $page <= $totalPage; $page++): ?>
    <?php $isActive = $page == $currentPage ? 'disabled' : '' ?>
    <a class="page-link <?=$isActive?> " href="/studentTable?page= <?=$page?>"><?=$page?></a>
    <?php endfor ?>
</div>
</div>



</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>