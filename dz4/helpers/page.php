<?php


/** функция формирования страницы
 *  т.к. по заданию все страницы однотипны, то формируе страницу в функции
 *  @param 
 *  @return 
 */

// как основной вариант
function viewTxt()
{
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $pageTitle = findPage($url);
    require $_SERVER['DOCUMENT_ROOT'] . '/helpers/templPage.php';
}

// function __viewTxt(string $pageTitle)
// {
//     $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //получаем URL страницы

//     //блок выводим через echo
//     echo " <div class=\"page\">
//                 <h1 class=\"page-header\"> $pageTitle </h1>   
//                 <p> вы находитесь по адресу: $url</p>
//            </div>
//         ";
// }