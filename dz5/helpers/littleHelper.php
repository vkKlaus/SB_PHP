<?php

/**
 * функция обрезания строки
 * @param string $element обрезаемая строка
 * @param string numberOfSymbols количество символов для проверки
 * @return string  обрезанная строка
 */
function cutString(string $element, int $numberOfSymbols): string
{
    //возвращаем...
    return mb_strlen($element,'UTF-8') <= $numberOfSymbols // проверяем если более .... символов
        ? $element //не обрезаем
        : mb_substr($element, 0, $numberOfSymbols - 3, 'UTF-8') . '...'; //обрезаем и добавляем многоточие
}

/**
 * функция определения активного пункта меню и присваивание класса для оформления стиля
 * @param string $element пункт меню
 * @param string $class определяемый класс
 * @return string  строка для формирования класса
 */
function activePoint(string $element, string $class): string
{
    return isCurrentUrl($element)
        ? $class
        : '';
}

/**
 * функция определения активного пункта меню и присваивание класса для оформления стиля
 * @param array $mainMenu массив меню
 * @return string  строка заголовок страницы
 */
function findPage($mainMenu): string
{
    foreach ($mainMenu as $value) {
        if (isCurrentUrl($value['path'])) {
            return 'страница: ' . $value['title'];
        }
    }
    return '???...' . defineUrl();
}

/**
 * функция определения активного url
 * @param 
 * @return string  url
 */
function defineUrl() : string
{
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}

 /**
 * функция определения активного url
 * @param string $url строка с адресом
 * @return bool  результат ставнения адреса текущей станицы с переданным гкд
  */
function isCurrentUrl(string $url) : bool
{
    return $url == defineUrl();
}

/**
 * функция сортировки
 * @param array $mainMenu - массив для сортировки 
 * @param string $typeSort - вид сортировки вид сортировки (asc - по возрвстанию, dsc - по убыванию)
 * @return array  отсортированный массив
 */
function sortArray($mainMenu,$typeSort) : array
{
     usort(
         $mainMenu,

         $typeSort == 'asc'
             ? function ($a, $b) {
                 return $a['sort'] > $b['sort']; //сортировка по возрастанию
             }
             : function ($a, $b) {
                 return $b['sort'] > $a['sort']; //сортировка по убыванию
             }
     );

     return $mainMenu;
}