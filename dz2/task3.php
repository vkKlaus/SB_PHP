<?php

$result3 = [
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dz-2 / Задание 3</title>
</head>

<body>
    <h3>Задание 3</h3>

    <p>
        <ul>
            <li> Для этой задачи возьмите предыдущий массив, положите его в переменную $result3 (Ctrl + C -> Ctrl + V). Ключами для каждого из авторов сделайте их email — чтобы на основе email автора у книги можно было получить автора. И теперь добавьте каждому автору еще и год рождения.</li>

            <li> Выведите информацию по всем книгам, в формате: “Книга <Название книги>, ее написал <Фио автора>
                        <Год Рождения автора> (<email автора>)”</li>

            <li> Затем перемешайте (Найдите подходящую функцию) книги и снова выведите информацию по книгам.</li>
        </ul>
    </p>

    <h3>решение</h3>

    <p>исходный массив</p>
    
    <pre>
        <?php
        echo '$result3</br></br>';
        var_dump($result3);
        ?>
    </pre>

    <<br>

        <p>вывод исходного массива</p>

        <ui>
            <?php
            foreach ($result3['books'] as $keyBook => $valBook) {
                echo '<li> Книга "'
                    . $valBook['title']
                    . '", ее написал '
                    . $result3['authors'][$valBook['email']]['author']
                    . ' ('
                    . $result3['authors'][$valBook['email']]['dataBr']
                    . ' г.р.) </li>';
            }
            ?>
        </ui>

        <br>

        <p>перемешаем книги и выведем</p>

        <ui>
            <?php
            shuffle($result3['books']);
            foreach ($result3['books'] as $keyBook => $valBook) {
                echo '<li> Книга "'
                    . $valBook['title']
                    . '", ее написал '
                    . $result3['authors'][$valBook['email']]['author']
                    . ' ('
                    . $result3['authors'][$valBook['email']]['dataBr']
                    . ' г.р.) </li>';
            }

            ?>

        </ui>

        <br>

        <a href="/">Назад</a>
</body>

</html>