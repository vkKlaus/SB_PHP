<?php

function findUser($login, $password)
{
    require_once $_SERVER['DOCUMENT_ROOT'].'/db/users.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/db/usersPs.php';

    $keyUser = array_search($login, $users);

    if ($keyUser === false) {
        var_dump($keyUser);
        return [false, 'пользователь не найден'];
    }

    if ($userPaswords[$keyUser] !== $password) {
        return [false, 'не правильный пароль'];
    }

    return [true, 'пользователь с id ' . $keyUser];
}
