<?php
/** функция формирования страницы
 *  т.к. по заданию все страницы однотипны, то формируе страницу в функции
 *  @param string $pageTitle заголовок страницы $pageTitle
 *  @return NULL
 */

function viewTxt(string $pageTitle)
{
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //получаем URL страницы

    //блок выводим через echo
    echo " <div class=\"page\">
                <h1 class=\"page-header\"> $pageTitle </h1>   
                <p> вы находитесь по адресу: $url</p>
           </div>
        ";
}

// как вариант
function __viewTxt(string $pageTitle)
{
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    //получаем URL страницы
    ?>

<!-- выводим блок страницы -->
     <div class="page">
        <h1 class="page-header"> <?= $pageTitle ?> </h1>   
        <p> вы находитесь по адресу: <?= $url ?></p>
    </div>

<?php
}
