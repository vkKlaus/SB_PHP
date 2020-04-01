<?php

$errorUser = '';
$titleUser = '';

$login = $_POST['login'];
if (empty($_POST['login'])) {
    $errorUser .= 'Поле e-mail не может быть пустым <br>';
};

if (empty($_POST['password'])) {
    $errorUser .= 'Поле пароль  не может быть пустым <br>';
};

if (empty($errorUser)) {

    existFileEnter();

    require $_SERVER['DOCUMENT_ROOT'] . '/db/users.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/db/usersPs.php';

    $indUser = array_search($_POST['login'], $users);

    if ($indUser === false) {
        $errorUser = 'Пользователь не найден. Вход воспрещен!';
    } elseif ($userPaswords[$indUser] != $_POST['password']) {
        $errorUser = 'Не правильный пароль. Вход воспрещен!';
    } else {
        $titleUser = 'Авторизация выполнена.';

        $_SESSION['login'] = $login;





        require $_SERVER['DOCUMENT_ROOT'] . '/helpers/exit.php';
    }
}
