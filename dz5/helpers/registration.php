<?php
$errorUser = '';
$titleUser = '';


if (empty($_POST['login'])) {
    $errorUser .= 'Поле e-mail не может быть пустым <br>';
};

if (empty($_POST['password_1'])) {
    $errorUser .= 'Поле пароль  не может быть пустым <br>';
};

if ($_POST['password_2'] != $_POST['password_1']) {
    $errorUser .= 'Пароли не одинаковы <br>';
};

if (empty($errorUser)) {

    existFileEnter();

    require $_SERVER['DOCUMENT_ROOT'] . '/db/users.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/db/usersPs.php';

    var_dump(findUser($_POST['login'], $users));
    if (findUser($_POST['login'], $users) === -1) {

        array_push($users, $_POST['login']);

        $resWrt = writeUsers($users, 'users', 'users');


        if ($resWrt != false) {
            array_push($userPaswords, $_POST['password_1']);

            $resWrt = writeUsers($userPaswords, 'userPaswords', 'usersPs');

            if ($resWrt == false) {
                $errorUser .= 'Ошибка записи пароля';
            }
        } else {
            $errorUser .= 'Ошибка записи пользователя';
        }

        $titleUser = 'Пользователь добавлен. Воспользуйтесь авторизацией';
    } else {
        $errorUser .= 'Пользователь уже зарегистрирован. Воспользуйтесь авторизацией';
    }
}
