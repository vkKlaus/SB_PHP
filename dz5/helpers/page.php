<?php


/** функция формирования страницы
 *  т.к. по заданию все страницы однотипны, то формируе страницу в функции
 *  @param array массив меню
 *  @return 
 */

// как основной вариант
function viewTxt($mainMenu)
{
    $pageTitle = findPage($mainMenu);
    require $_SERVER['DOCUMENT_ROOT'] . '/template/templPage.php';
}
