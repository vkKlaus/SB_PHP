<?php

$errorUser = $titleUser = '';

$login = $_POST['login'];
if (empty($_POST['login'])) {
    $errorUser .= 'Поле e-mail не может быть пустым <br>';
} elseif (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
    $errorUser .= "E-mail адрес '$login' указан не верно.<br>";
}

if (empty($_POST['password'])) {
    $errorUser .= 'Поле пароль  не может быть пустым <br>';
}

if (!empty($errorUser)) {
    $login = $_POST['login'];
} else {
    $sql = 'SELECT * FROM users WHERE email = :email LIMIT 1';

    $sql = 'SELECT users.id, users.password, group_user.user_id, group_user.group_id 
    FROM users 
    LEFT OUTER JOIN group_user 
    ON users.id = group_user.user_id  
    WHERE users.email=:email';

    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute(['email' => $_POST['login']]);


    if (!$result) {
        $errorUser .= 'Ошибка выполнения запроса. Обратитесь к администратору!';
    } elseif ($stmt->rowCount() == 0) {
        $errorUser .= 'Пользователь не найден. Вход воспрещен!';
    } else {
        $row = $stmt->fetchAll();

        if (!password_verify($_POST['password'], $row[0]['password'])) {
            $errorUser .= 'Не верный пароль. Вход воспрещен!';
        } else {
            $titleUser = 'Авторизация выполнена.';
            $_SESSION['login'] = $login;
            $_SESSION['admin'] = false;
            foreach ($row as $item) {

                if ($item['group_id'] == '999') {
                    $_SESSION['admin'] = true;
                }
            }

            require $_SERVER['DOCUMENT_ROOT'] . '/helpers/exit.php';
        }
    }
}
