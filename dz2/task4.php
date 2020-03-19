<?php

$result4 = [
    'authors' => [
        'Кобах@ru' => [
            'author' => 'Кобах Сергей',
            'dataBr' => '01.01.2000'

        ],

        'Гаррисон@com' => [
            'author' => 'Гаррисон Гарри',
            'dataBr' => '01.01.2000'
        ],

        'Загорцев@ru' => [
            'author' => 'Загорцев Андрей',
            'dataBr' => '01.01.2000'
        ]
    ],

    'books' => [
        [
            'title' => 'Верх тормашками - вниз аджикой',
            'email' => 'Кобах@ru'
        ],
        [
            'title' => 'Наверное, я зря встал на лыжи',
            'email' => 'Кобах@ru'
        ],
        [
            'title' => 'Злобная кухня',
            'email' => 'Кобах@ru'
        ],
        [
            'title' => 'Рождение стальной крысы',
            'email' => 'Гаррисон@com'
        ],
        [
            'title' => 'Стальная крыса спасает мир',
            'email' => 'Гаррисон@com'
        ],
        [
            'title' => 'Стальная крыса идет в армию',
            'email' => 'Гаррисон@com'
        ],
        [
            'title' => 'Спецуха',
            'email' => 'Загорцев@ru'
        ],
        [
            'title' => 'Особая группа',
            'email' => 'Загорцев@ru'
        ],
        [
            'title' => 'Спецназ третий мировой',
            'email' => 'Загорцев@ru'
        ]
    ]
];

$red = (bool) rand(0, 1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dz-2 / Задание 4</title>
    <style type="text/css">
        .red {
            color: red;
        }
    </style>
</head>

<body>
    <h1 <?= $red ? 'class="red"' : "" ?>>Советую почитать</h1>

    <div>
        Авторов на портале: <?= count($result4['authors']) ?>
    </div>

    <?php
    foreach ($result4['books'] as $keyBook => $valBook) {
        echo '<p> Книга "'
            . $valBook['title']
            . '", ее написал '
            . $result4['authors'][$valBook['email']]['author']
            . ' ('
            . $result4['authors'][$valBook['email']]['dataBr']
            . ' г.р.)</p>';
    }
    ?>

     <br>

    <a href="/">Назад</a>
</body>

</html>