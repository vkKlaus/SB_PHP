<?php

session_start();

if (isset($_SESSION['login'])) {
    setcookie('login', $_SESSION['login'], time() + 2592000, '/');
}

if ($_SERVER['REQUEST_URI'] != '/' && mb_strpos($_SERVER['REQUEST_URI'], '/route/enter/') === false) {
    if (empty($_SESSION['login'])) {
        require $_SERVER['DOCUMENT_ROOT'] . '/helpers/exit.php';
    }
}


require $_SERVER['DOCUMENT_ROOT'] . '/db/main_menu.php'; //данные меню
require $_SERVER['DOCUMENT_ROOT'] . '/helpers/menu.php'; // подключаем формирование меню
require $_SERVER['DOCUMENT_ROOT'] . '/helpers/littleHelper.php'; // подключаем формирование меню
require $_SERVER['DOCUMENT_ROOT'] . '/helpers/page.php'; // подключаем формирование страницы

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dz5</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/jquery.fancybox.min.css" />
</head>

<body>
    <header>
        <div class="left-header">
            <!-- выводим логотип -->
            <a href="/"><img src="/img/logo.png" alt="logo"></a>
            <!-- выводим горизонтальное меню сформированное по возрастанию пунктов -->
            <?php createMenu($mainMenu, 'asc', 'horizontal') ?>
        </div>

        <div class="right-header">

            <!-- авторизация / регистрация -->
            <a href="/route/enter/?enter=<?= !empty($_SESSION['login']) ? 'exit' : 'autor' ?>" class="horizontal-menu-link">
                <span class="horizontal-menu-element">
                    <?= !empty($_SESSION['login']) ? 'выйти' : 'войти на сайт' ?>

                </span>


                <?php if (!empty($_SESSION['login'])) { ?>
                    <div class="autor-yes">
                        <?= $_SESSION['login'] ?>

                    </div>
                <?php } else { ?>
                    <div class="autor-no">
                        авторизируйтесь
                    </div>
                <?php } ?>

            </a>
        </div>
    </header>