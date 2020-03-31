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

    $existFiles = true; //флаг заполненности директории (есть файлы изображений)

    if (!file_exists($dir)) { //если директории нет, то создаем ее 
        mkdir($dir);
        $existFiles = false; //директория пустая
    } else {
        $arrDirImg = scandir($dir); //директоря есть, но вдруг пустая

        if (!$arrDirImg) {
            $existFiles = false; //директория пустая
        } else {                //директоря есть, и вроде не пустая

            $arrDirImg = delRootDir($arrDirImg);     //удаляем (.) и (..)
            foreach ($arrDirImg as $ind => $item) {
                $arrDirImg[$ind] =  $dir . $arrDirImg[$ind]; //преобразуем имена файлов в полный путь
            };

            //фильтруем по mime (изображение)
            $arrDirImg = array_filter(
                $arrDirImg,
                function ($element) {
                    return   mb_strpos(mime_content_type($dir . $element), 'image') === 0;
                }
            );

            if (count($arrDirImg) == 0) {
                $existFiles = false;   //директория считается пустой (даже если там есть файл не изображений)
            }
        }
    }

    return $existFiles;
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
            return $element != '.' && $element != '..';
        }
    );
}

/**
 * функция проверки правильности загрузки
 * @param int  $countFiles - разрешенное к загрузке количество файлов 
 * @param bool  $onlyImg - разрешеннs к загрузке только картинки 
 * @param array  $typeFiles - количесво и тип загружаемых файлов 
 * @return array - массив ошибок
 */
function checlLoad(int $countFiles, bool $onlyImg, array $typeFiles): array
{
    $result = [
        'load' => true,
        'errorCount' => 0,
        'errorType' => 0
    ];

    if ($countFiles < count($typeFiles) && $countFiles != 0) {
        $result['load'] = false;
        $result['errorCount'] = count($typeFiles) - $countFiles;
    }

    if ($onlyImg) {
        $arrayType = array_filter(
            $typeFiles,
            function ($fileType) {
                return  mb_strpos($fileType, 'image') === false;
            }
        );

        if (count($arrayType) != 0) {
            $result['load'] = false;
            $result['errorType'] = count($arrayType);
        }
    }

    return $result;
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
