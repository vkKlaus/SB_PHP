
<?php 

$result2 = [
    'authors' => [
        [
            'author' => 'Кобах Сергей',
            'email' => 'Кобах@ru'
        ],
        [
            'author' => 'Гаррисон Гарри',
            'email' => 'Гаррисон@com'
        ],
        [
            'author' => 'Загорцев Андрей',
            'email' => 'Загорцев@ru'
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
    <title>dz-2 / Задание 2</title>
</head>

<body>
    <h3>Задание 2</h3>

            <p>Теперь расширим этот массив — создадим новый, в котором будет много авторов и много книг. Создайте
                многомерный массив $result2 — с двумя ключами ‘authors’ и ‘books’:
                <ul>
                    <li> в индекс (ключ) ‘authors’ добавьте многомерный массив каждый элемент которого является автором, т.е. ассоциативным массивом данных об авторе: фио, email (как в задании 1);</li>
                    <li> в индекс (ключ) ‘books’ добавьте многомерный массив каждый элемент которого является книгой, т.е. ассоциативным массивом данных о книге: название и email автора (как в задании 1);</li>
                    <li> Создайте несколько авторов и несколько книг;</li>
                    <li> Выведите массив.</li>
                </ul>
            </p>

        
    <h3>решение</h3>

    <pre>
        <?php
        echo '$result2</br></br>';
        var_dump($result2);
        ?>
    </pre>
    
    <a href="/">Назад</a>
</body>

</html>