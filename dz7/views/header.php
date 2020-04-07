<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/helpers/menu.php'; // подключаем формирование меню
require $_SERVER['DOCUMENT_ROOT'] . '/helpers/littleHelper.php'; // подключаем формирование меню
require $_SERVER['DOCUMENT_ROOT'] . '/helpers/page.php'; // подключаем формирование страницы
require $_SERVER['DOCUMENT_ROOT'] . '/helpers/pdo_db.php';

if (isset($_SESSION['login'])) {
    setcookie('login', $_SESSION['login'], time() + 2592000, '/');
}

$admin = false;

if (isset($_SESSION['admin'])) {
    $admin = $_SESSION['admin'];
}

if ($_SERVER['REQUEST_URI'] != '/' && mb_strpos($_SERVER['REQUEST_URI'], '/route/enter/') === false) {
    if (isAuth()) {
        require $_SERVER['DOCUMENT_ROOT'] . '/helpers/exit.php';
    }
}




$pdo = connect();

$sql = 'SELECT title, path, id as sort 
        FROM main_menu 
        WHERE usePanel=1 '
    . (($admin) ? '' : ' AND  adm_panel = 0');

$stmt = $pdo->query($sql);
$mainMenu = [];
while ($row = $stmt->fetch()) {
    array_push($mainMenu, $row);
}


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
            <?php createMenu($mainMenu, 'asc', 'horizontal', $admin) ?>
        </div>

        <div class="right-header">

            <!-- авторизация / регистрация -->
            <a href="/route/enter/?enter=<?= !isAuth() ? 'exit' : 'autor' ?>" class="horizontal-menu-link">
                <span class="horizontal-menu-element">
                    <?= !isAuth() ? 'выйти' : 'войти на сайт' ?>

                </span>


                <?php if (!isAuth()) { ?>
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