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
    return mb_strlen($element, 'UTF-8') <= $numberOfSymbols // проверяем если более .... символов
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
function defineUrl(): string
{
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}

/**
 * функция определения активного url
 * @param string $url строка с адресом
 * @return bool  результат ставнения адреса текущей станицы с переданным гкд
 */
function isCurrentUrl(string $url): bool
{
    return $url == defineUrl();
}

/**
 * функция сортировки
 * @param array $mainMenu - массив для сортировки 
 * @param string $typeSort - вид сортировки вид сортировки (asc - по возрвстанию, dsc - по убыванию)
 * @return array  отсортированный массив
 */
function sortArray($mainMenu, $typeSort): array
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

/**
 * функция проверки каталога и наличия файлов в нем
 * @param string $dir - путь к каталогу для проверки
 * @return bool  переменая наличия файлов в существующем (созданном) каталоге
 */
function scanDirFile(string $dir): bool
{
if (!file_exists($dir)) { //если директории нет, то создаем ее 
mkdir($dir);
return false; //директория пустая - возращаем нет картинок
}
 $arrDirImg = delRootDir(scandir($dir)); //директоря есть, но вдруг пустая
if (!$arrDirImg) {
    return false; //директория пустая - возращаем нет картинок
}
//директоря есть, и вроде не пустая

    foreach ($arrDirImg as $ind => $item) {

        if (mb_strpos(mime_content_type($dir . $arrDirImg[$ind]), 'image') !== false) {
            return true;            //нашли картинку в директории - возращаем есть картина
        }
    };

    return false; //директория не пустая, но картинок нет - возращаем нет картинок
}

/**
 * функция фильтации массива файлов дирректории
 * @param array  $arrayElements - массив элементов 
 * @return array  отфильтрованный массив
 */
function delRootDir(array $arrayElements): array
{
    return  array_filter(
        $arrayElements,
        function ($element) {  //из массива файлов даляем (.) и (..)
            return (!in_array($element, ['.', '..']));
        }
    );
}


/** функция проверки существования файла авторизации и пароля. если не - создаем
 * @param  
 * @return 
 */
function existFileEnter()
{

    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/db/users.php') || !file_exists($_SERVER['DOCUMENT_ROOT'] . '/db/usersPs.php')) {
        file_put_contents(
            $_SERVER['DOCUMENT_ROOT'] . '/db/users.php',
            '<?php $users = [];'
        );

        file_put_contents(
            $_SERVER['DOCUMENT_ROOT'] . '/db/usersPs.php',
            '<?php $userPaswords = [];'
        );
    }
}

/** функция поиска индекса user
 * @param  string - user
 * @param  array - массив для поиска user
 * @return int - индекс user / -1 - user не найден
 */
function findUser(string $login, array $users): int
{
    $ind = array_search($login, $users);
    return ($ind === false ? -1 :  $ind);
}

/** функция поиска индекса user
 * @param  array - массив пользователей
 * @param  string - имя массива
 * @param  string - путь к файлу
 * @return bool - результат записи
 */
function writeUsers(array $users, string $nameArray, string $path): bool
{
    $strU = '<?php $' . $nameArray . ' = [';

    foreach ($users as $element) {
        $strU .= '"' . $element . '",';
    }

    $res = file_put_contents(
        $_SERVER['DOCUMENT_ROOT'] . '/db/' . $path . '.php',
        $strU . '];'
    );

    if ($res != false) {
        return true;
    } else {
        return false;
    }
}
