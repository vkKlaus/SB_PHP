<?php
$errorUser = '';
$titleUser = '';

$login = $_POST['login'];
if (empty($_POST['login'])) {
    $errorUser .= 'Поле e-mail не может быть пустым <br>';
}

if (empty($_POST['password_1'])) {
    $errorUser .= 'Поле пароль  не может быть пустым <br>';
}

if ($_POST['password_2'] != $_POST['password_1']) {
    $errorUser .= 'Пароли не одинаковы <br>';
}

if (empty($errorUser)) {

    existFileEnter();

    require $_SERVER['DOCUMENT_ROOT'] . '/db/users.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/db/usersPs.php';

    $indUser = array_search($_POST['login'], $users);

    if ($indUser !== false) {

        $userPaswords[$indUser] = $_POST['password_1'];

        $resWrt = writeUsers($userPaswords, 'userPaswords', 'usersPs');

        if ($resWrt == false) {
            $errorUser .= 'Ошибка записи пароля';
        } else {
            $titleUser = 'Пароль изменен. Воспользуйтесь авторизацией';
            $login = '';
        }
    } else {
        $errorUser .= 'Пользователь не найден. Проверте правильность e-mail';
    }
}
