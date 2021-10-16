<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/src/front/css/style.css">
    <link rel="stylesheet" href="/src/front/css/toast.css">
    <script src="/src/front/js/jquery-3.4.1.min.js"></script>
    <title>МастерОк</title>
</head>
<body>

<!--  Шапка старт  -->
<header class="green">
    <div class="header">
        <div class="logo">
            <img src="/src/front/logo/logo_ok.png" alt="Logo" class="img">
        </div>
        <nav>
            <ul>
                <li><a href="/" class="white-text">Главная</a></li>
                <?php
                if (empty($_SESSION['login']))
                {
                    echo '<li><a href="#registr" class="white-text">Регистрация</a></li>
                          <li><a href="#login " class="white-text">Авторизация</a></li>';
                } else {
                    echo '<li><a href="/" class="white-text">'.$_SESSION['login'].'</a></li>
                          <li><a href="/logout.php" class="white-text">Выйти</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</header>
<!--  Шапка конец -->

<!--  Toast хранилище старт  -->
<div class="toasts__container">

</div>
<!--  Toast хранилище конец  -->

<!--  Контейнер страницы старт  -->
<div class="container">