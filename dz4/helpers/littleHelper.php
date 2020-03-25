<?php
/**
 * функция обрезания строки
 * @param string $element обрезаемая строка
 * @param string numberOfSymbols количество символов для проверки
 *
 * @return string  обрезанная строка
 */
function cutString(string $element, int $numberOfSymbols): string
{
    //возвращаем...
    return mb_strlen($element) <= $numberOfSymbols // проверяем если более .... символов
        ? $element //не обрезаем
        : mb_substr($element, 0, $numberOfSymbols - 3) . '...'; //обрезаем и добавляем многоточие
}

/**
 * функция определения активного пункта меню и присваивание класса для оформления стиля
 * @param string $element пункт меню
 * @param string $class определяемый класс
 *
 * @return string  строка для формирования класса
 */
function activePoint(string $element, string $class): string
{
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == $element
        ? $class
        : '';
}

/**
 * функция определения активного пункта меню и присваивание класса для оформления стиля
 * @param string $url url страницы
 *
 * @return string  строка заголовок страницы
 */
function findPage(string $url): string
{
    require $_SERVER['DOCUMENT_ROOT'] . '/db/main_menu.php';

    foreach ($mainMenu as $value) {
        if ($value['path'] == $url) {
            return 'страница: ' . $value['title'];
        }
    }

    return '???...' . $url;
}
