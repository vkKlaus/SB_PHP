<?php

function findUser($login, $password)
{
    require_once $_SERVER['DOCUMENT_ROOT'] . '/db/users.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/db/usersPs.php';

    $keyUser = array_search($login, $users);

    if ($keyUser === false) {
        return 1;
    }

    if ($userPaswords[$keyUser] !== $password) {
        return 2;
    }

    return 0;
}
