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

    if (array_search($_POST['login'], $users) === false) {

        array_push($users, $_POST['login']);

        $resWrt = writeUsers($users, 'users', 'users');


        if ($resWrt != false) {
            array_push($userPaswords, $_POST['password_1']);

            $resWrt = writeUsers($userPaswords, 'userPaswords', 'usersPs');

            if ($resWrt == false) {
                $errorUser .= 'Ошибка записи пароля';
            } else {
                $titleUser = 'Пользователь добавлен. Воспользуйтесь авторизацией';
                $login = '';
            }
        } else {
            $errorUser .= 'Ошибка записи пользователя';
        }
    } else {
        $errorUser .= 'Пользователь уже зарегистрирован. Воспользуйтесь авторизацией';
    }
}
