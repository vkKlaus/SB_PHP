<?php

$result1 = [
    'authors' => [
        [
            'author' => '',
            'email' => ''
        ]
    ],
    'books' => [
        [
            'title' => '',
            'email' => ''
        ]
    ]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dz-2 / Задание 1</title>
</head>

<body>
    <h3>Задание 1</h3>

    <p>Начнем с создания простых массивов с данными об авторе и книге. Создайте многомерный массив $result1 — с
        двумя ключами ‘author’ и ‘book’
        <ul>
            <li> в индекс (ключ) ‘author’ добавьте ассоциативный массив данных об авторе: фио, email</li>

            <li> в индекс (ключ) ‘book’ добавьте ассоциативный массив данных о книге: название и email автора</li>

            <li> Выведите массив.</li>
        </ul>
    </p>

    <h3>решение</h3>

    <pre>
        <?php
        echo '$result1</br></br>';
        var_dump($result1);
        ?>
    </pre>

    <a href="/">Назад</a>
</body>

</html>