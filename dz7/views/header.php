<?php

session_start();


require $_SERVER['DOCUMENT_ROOT'] . '/helpers/menu.php'; // подключаем формирование меню
require $_SERVER['DOCUMENT_ROOT'] . '/helpers/littleHelper.php'; // подключаем формирование меню
require $_SERVER['DOCUMENT_ROOT'] . '/helpers/page.php'; // подключаем формирование страницы
require $_SERVER['DOCUMENT_ROOT'] . '/helpers/pdo_db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/helpers/pdo_query.php';



if (!isAuth()) {
    setcookie('login', $_SESSION['login'], 0, '/?sort=1');
} else {
    setcookie('login', '', -1, '/?sort=1');
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

//определяем роль добавления разделов group_id==3
$roleCrSect = selectUserGroup($pdo);
$roleCrSect = array_filter(
    $roleCrSect,
    function ($element) {
        return ($element['group_id'] == 3);
    }
);


$mainMenu = [];

if (isset($_SESSION['mainMenu'])) {
    $mainMenu = $_SESSION['mainMenu'];
} else {
    $menuPDO = selectMenu($pdo);
    $mainMenu = [];

    foreach ($menuPDO as $item) {
        if (!isset($_SESSION['login']) && strpos($item['title'], 'Главная') !== 0) {
            continue;
        }
        array_push($mainMenu, $item);
    }

    $_SESSION['mainMenu'] = $mainMenu;
}



verifyRight();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dz7</title>
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