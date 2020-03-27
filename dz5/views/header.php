<?php

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
        <!-- выводим логотип -->
        <a href="/"><img src="/img/logo.png" alt="logo"></a>
        <!-- выводим горизонтальное меню сформированное по возрастанию пунктов -->
       <?php createMenu($mainMenu,'asc','horizontal') ?>
    </header>