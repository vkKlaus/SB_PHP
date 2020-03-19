<?php

$lengthRoad = rand(40, 1000);
$speedCity = 70;
$speedRoad = 90;

$city1Radius = rand(1, 10);
$city1 = rand($city1Radius, round($lengthRoad / 2));

$city2Radius = rand(1, 10);
$city2 = rand($city1Radius + $city1Radius + $city2Radius, $lengthRoad);


$car = [];

for ($i = 1; $i <= 10; $i++) {
    $car['car' . $i] = rand(0, $lengthRoad);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dz-2 / Задание 1</title>
</head>

<body>
    <h3>Задание 5</h3>

    <p>Шоссе проходит через два города, в городе ограничение скорости 70 км/ч, за городом 90 км/ч. Даны (заведите
        переменные со значением) $city1 — километр шоссе — центр первого города, $city1Radius — радиус города 1,
        $city2 — километр шоссе — центр второго города, $city2Radius — радиус второго города.
        Есть 10 машин, для каждой задан километр шоссе (случайное целое число) на котором машина находится. Все
        автолюбители соблюдают скоростной режим. Для каждой машины выведите подобную строку:
        “Машина 4 едет по городу на 3 км со скоростью 70”
    </p>

    <h3>исходные данные</h3>

    <ul>
        <li>Скорость в городе: <?= $speedCity ?> км/ч</li>
        <li>Скорость на шоссе: <?= $speedRoad ?> км/ч</li>
        <li>Длинна шоссе: <?= $lengthRoad ?> км</li>
        <li>Город А точка: <?= $city1 ?> км</li>
        <li>Город А радиус: <?= $city1Radius ?> км</li>
        <li>Город А точка граница1: <?= $city1 - $city1Radius ?> км</li>
        <li>Город А точка граница2: <?= $city1 + $city1Radius ?> км</li>
        <li>Город В точка: <?= $city2 ?> км</li>
        <li>Город В радиус: <?= $city2Radius ?> км</li>
        <li>Город В точка граница1: <?= $city2 - $city2Radius ?> км</li>
        <li>ГородВ точка граница2: <?= $city2 + $city2Radius ?> км</li>
    </ul>

    <ul>
        <?php
        foreach ($car as $num => $position) {
            echo "<li> автомобиль: \"$num\"  / позиция:$position  км </li>";
        }
        ?>
    </ul>

    <h3>решение</h3>
    <ul>
        <?php
        foreach ($car as $num => $position) {
            if ($position < $city1 - $city1Radius) {
                echo "<li> автомобиль \"$num\" находится  перед городом А  в точке $position км. Скорость $speedRoad </li>";
            } elseif ($position <= $city1 + $city1Radius) {
                echo "<li> автомобиль \"$num\" находится  в городе А  в точке $position км. Скорость $speedCity </li>";
            } elseif ($position < $city2 - $city2Radius) {
                echo "<li> автомобиль \"$num\" находится  между  городами А и В  в точке $position км. Скорость $speedRoad </li>";
            } elseif ($position <= $city2 + $city2Radius) {
                echo "<li> автомобиль \"$num\" находится в городе В  в точке $position км. Скорость $speedCity </li>";
            } else {
                echo "<li> автомобиль \"$num\" находится за городом В  в точке $position км. Скорость $speedRoad </li>";
            }
        }
        ?>
    </ul>

    <a href="/">Назад</a>
</body>

</html>