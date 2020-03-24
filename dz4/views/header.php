<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/menu.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dz4</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <header>
        <a href="/"><img src="/img/logo.png" alt="logo"></a>
        <ul class="horizontal-menu">
            <?php
            foreach ($mainMenu as $element) { ?>
                <li>
                    <a href="<?= $element['path'] ?>" class="horizontal-menu-link">
                        <div class="horizontal-menu-element">
                            <?= (mb_strlen($element['title']) <= 15 ?
                                $element['title'] :
                                mb_substr($element['title'], 0, 12) . '...') ?>
                        </div>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </header>