<?php

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dz-2 / Задание 1</title>
</head>

<body>
    <h3>Задание 6</h3>

    <p>Создайте переменную $studentsCount — присвойте ей случайное значение от 1 до 1000000.
        Создайте программу, которая выведет в нужной форме текстовое сообщение, например такие “на учебе 100
        студентов”, или “на учебе 2 студента” и т.д.
    </p>

    <h3>решение</h3>

    <p> на учебе <?= $studentsCount . ' ' . $studentWord ?> </p>

    <a href="/">Назад</a>
</body>

</html>