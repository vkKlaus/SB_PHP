<pre>
<?php
// Задание 1
$result1 = [
    'autor' => [
        [
            'name' => '',
            'email' => ''
        ]
    ],
    'book' => [
        [
            'name' => '',
            'email' => ''
        ]
    ]
];
// Задание 2
$result2 = [
    'autor' => [
        [
            'name' => 'Кобах Сергей',
            'email' => 'Кобах@ru'
        ],
        [
            'name' => 'Гаррисон Гарри',
            'email' => 'Гаррисон@com'
        ],
        [
            'name' => 'Загорцев Андрей',
            'email' => 'Загорцев@ru'
        ]
    ],
    'book' => [
        [
            'name' => 'Верх тормашками - вниз аджикой',
            'email' => 'Кобах@ru'
        ],
        [
            'name' => 'Наверное, я зря встал на лыжи',
            'email' => 'Кобах@ru'
        ],
        [
            'name' => 'Злобная кухня',
            'email' => 'Кобах@ru'
        ],
        [
            'name' => 'Рождение стальной крысы',
            'email' => 'Гаррисон@com'
        ],
        [
            'name' => 'Стальная крыса спасает мир',
            'email' => 'Гаррисон@com'
        ],
        [
            'name' => 'Стальная крыса идет в армию',
            'email' => 'Гаррисон@com'
        ],
        [
            'name' => 'Спецуха',
            'email' => 'Загорцев@ru'
        ],
        [
            'name' => 'Особая группа',
            'email' => 'Загорцев@ru'
        ],
        [
            'name' => 'Спецназ третий мировой',
            'email' => 'Загорцев@ru'
        ]
    ]
];

// Задание 3
$result3 = [
    'autor' => [
        [
            'name' => 'Кобах Сергей',
            'email' => 'Кобах@ru',
            'dataBr' => '01.01.2000'
        ],
        [
            'name' => 'Гаррисон Гарри',
            'email' => 'Гаррисон@com',
            'dataBr' => '01.01.2000'
        ],
        [
            'name' => 'Загорцев Андрей',
            'email' => 'Загорцев@ru',
            'dataBr' => '01.01.2000'
        ]
    ],
    'book' => [
        [
            'name' => 'Верх тормашками - вниз аджикой',
            'email' => 'Кобах@ru'
        ],
        [
            'name' => 'Наверное, я зря встал на лыжи',
            'email' => 'Кобах@ru'
        ],
        [
            'name' => 'Злобная кухня',
            'email' => 'Кобах@ru'
        ],
        [
            'name' => 'Рождение стальной крысы',
            'email' => 'Гаррисон@com'
        ],
        [
            'name' => 'Стальная крыса спасает мир',
            'email' => 'Гаррисон@com'
        ],
        [
            'name' => 'Стальная крыса идет в армию',
            'email' => 'Гаррисон@com'
        ],
        [
            'name' => 'Спецуха',
            'email' => 'Загорцев@ru'
        ],
        [
            'name' => 'Особая группа',
            'email' => 'Загорцев@ru'
        ],
        [
            'name' => 'Спецназ третий мировой',
            'email' => 'Загорцев@ru'
        ]
    ]
];

// Задание 4

$red = (bool) rand(0, 1);
$title = '<h2' . ($red ? ' class ="red"' : '') . '> Советую почитать </h2>';

$result4 = ($result3);

// Задание 5
$speedCity = 70;
$speedRoad = 90;

$city1Radius = rand(1, rand(1, 10));
$city1 = $city1Radius;
$city2Radius = rand(1, rand(1, 10));
$city2 = rand(
    $city1Radius + $city2Radius,
    rand($city1Radius + $city2Radius, 100)
);

$car = [];

for ($i = 1; $i <= 10; $i++) {
    $car['car' . $i] = rand(0, $city2 + $city2Radius + 5);
}

//Задание 6

$studentsCount = (string) rand(1, 1000000);

$studentWord = 'студент';

$endSymbol2 = (int) substr($studentsCount, -2);

$endSymbol1 = (int) substr($studentsCount, -1);

if (
    (5 <= $endSymbol2 && $endSymbol2 < 20) ||
    $endSymbol1 == 0 ||
    (5 <= $endSymbol1 && $endSymbol1 <= 9)
) {
    $studentWord .= 'ов';
} elseif (2 <= $endSymbol1 && $endSymbol1 <= 4) {
    $studentWord .= 'а';
}
?>
</pre>

<!DOCTYPE html>
<html lang=ru>

<head>
    <meta charset=UTF-8>
    <meta name=viewport content=width=device-width, initial-scale=1.0>
    <title>dz2 по курсу PHP</title>
    <style>
        .red {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>
    <ul>
        <li>
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

            <?php
            echo 'result1' . '<br>';
            foreach ($result1 as $keyResult => $valResult) {
                echo '   > ' . $keyResult . '<br>';
                foreach ($valResult as $keyArr => $valArr) {
                    echo '   >    > ' . $keyArr . '<br>';
                    foreach ($valArr as $keyData => $valData) {
                        echo '   >    >    > ' . $keyData . '<br>';
                    }
                }
            }
            ?>
        </li>

        <hr>

        <li>
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
            <?php
            echo 'result2' . '<br>';
            foreach ($result2 as $keyResult => $valResult) {
                echo '   > ' . $keyResult . '<br>';
                foreach ($valResult as $keyArr => $valArr) {
                    echo '   >    > ' . $keyArr . '<br>';
                    foreach ($valArr as $keyData => $valData) {
                        echo '   >    >    > ' .
                            $keyData .
                            ' => ' .
                            $valData .
                            '<br>';
                    }
                }
            }
            ?>
        </li>

        <hr>

        <li>
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
            <?php
            echo 'result3' . '<br>';
            foreach ($result3 as $keyResult => $valResult) {
                echo '   > ' . $keyResult . '<br>';
                foreach ($valResult as $keyArr => $valArr) {
                    echo '   >    > ' . $keyArr . '<br>';
                    foreach ($valArr as $keyData => $valData) {
                        echo '   >    >    > ' .
                            $keyData .
                            ' => ' .
                            $valData .
                            '<br>';
                    }
                }
            }

            
            for ($i = 0; $i <= 3; $i++) {
                echo '<br>';
                foreach ($result3['book'] as $keyArr => $valArr) {
                    foreach ($result3['autor'] as $keyAutor => $valAutor) {
                        if ($valAutor['email'] == $valArr['email']) {
                            break;
                        }
                    }
                    echo '' .
                        $keyArr .
                        ' книга: "' .
                        $valArr['name'] .
                        '" автор: ' .
                        $valAutor['name'] .
                        ' (' .
                        substr($valAutor['dataBr'], -4) .
                        ' г.р.) <br>';
                }
                shuffle($result3['book']);
            }
  
            ?>
        </li>

        <hr>

        <li>

            <h3>Задание 4</h3>

            <p>
                <ul>
                    <li> Возьмите массив из задания 3, создайте переменную $title — в нее впишите любую строку — это
                        будет заголовок страницы.
                    <li> Также создайте переменную boolean типа $red = (bool) rand(0, 1);
                    <li> Сформируйте небольшую веб-страницу (верстка приложена), у которой будет заголовок, и в абзацах
                        выведены книги в том же формате, что и в задании 3. Каждая книга должна быть в отдельном абзаце.
                    <li> Интегрируйте код в приложенную верстку, при этом если переменная $red истинна — необходимо к
                        заголовку h1 добавить атрибут class=”red” (файл.php в прикрепленных материалах)
                </ul>
            </p>
            <?= $title ?>
            <?php
            
         
            echo '<br>';

            foreach ($result4['book'] as $keyArr => $valArr) {
                foreach ($result3['autor'] as $keyAutor => $valAutor) {
                    if ($valAutor['email'] == $valArr['email']) {
                        break;
                    }
                }
                echo '<p>' .
                    ' > книга: "' .
                    $valArr['name'] .
                    '" / автор: ' .
                    $valAutor['name'] .
                    ' (' .
                    substr($valAutor['dataBr'], -4) .
                    ' г.р.) / электронная почта:'. $valArr['email'].' </p><br>';
            }
            ?>
        </li>

        <hr>

        <h3>Задание 5</h3>

        <p>Шоссе проходит через два города, в городе ограничение скорости 70 км/ч, за городом 90 км/ч. Даны (заведите
            переменные со значением) $city1 — километр шоссе — центр первого города, $city1Radius — радиус города 1,
            $city2 — километр шоссе — центр второго города, $city2Radius — радиус второго города.
            Есть 10 машин, для каждой задан километр шоссе (случайное целое число) на котором машина находится. Все
            автолюбители соблюдают скоростной режим. Для каждой машины выведите подобную строку:
            “Машина 4 едет по городу на 3 км со скоростью 70”
        </p>

        <h3>решение</h3>
        <?php
        echo '$speedCity' . ' = ' . $speedCity . '<br>';
        echo '$speedRoad' . ' = ' . $speedRoad . '<br>';

        echo '$city1Radius' . ' = ' . $city1Radius . '<br>';
        echo '$city1' . ' = ' . $city1 . '<br>';
        echo '$city2Radius' . ' = ' . $city2Radius . '<br>';
        echo '$city2' . ' = ' . $city2 . '<br>';

        echo '<br>';

        foreach ($car as $key => $val) {
            if ($val <= $city1Radius * 2) {
                echo 'автомобиль ' .
                    $key .
                    ' едет по городу "city1" на ' .
                    $val .
                    ' км. шоссе со скоростью ' .
                    $speedCity .
                    ' км/ч<br>';
            } elseif ($val < $city2 - $city2Radius) {
                echo 'автомобиль ' .
                    $key .
                    ' едет по шоссе  на ' .
                    $val .
                    ' км.  со скоростью ' .
                    $speedRoad .
                    ' км/ч<br>';
            } elseif (
                $city2 - $city2Radius <= $val &&
                $val <= $city2 + $city2Radius
            ) {
                echo 'автомобиль ' .
                    $key .
                    ' едет по городу "city2" на ' .
                    $val .
                    ' км. шоссе со скоростью ' .
                    $speedCity .
                    ' км/ч<br>';
            } else {
                echo 'автомобиль ' .
                    $key .
                    ' уехал из  "city2" на ' .
                    $val .
                    ' км. шоссе со скоростью ' .
                    $speedRoad .
                    ' км/ч<br>';
            }
        }
        ?>

        </li>
        <li>
            <hr>
            <h3>Задание 6</h3>

            <p>Создайте переменную $studentsCount — присвойте ей случайное значение от 1 до 1000000.
                Создайте программу, которая выведет в нужной форме текстовое сообщение, например такие “на учебе 100
                студентов”, или “на учебе 2 студента” и т.д.
            </p>

            <h3>решение</h3>

            <p> на учебе <?= $studentsCount . ' ' . $studentWord ?> </p>
        </li>
    </ul>
</body>

</html>