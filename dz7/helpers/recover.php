<?php
$errorUser = '';
$titleUser = '';

$login = $_POST['login'];
if (empty($_POST['login'])) {
    $errorUser .= 'Поле e-mail не может быть пустым <br>';
} elseif (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
    $errorUser .= "E-mail адрес '$login' указан не верно.<br>";
}


if (empty($_POST['password_1'])) {
    $errorUser .= 'Поле пароль  не может быть пустым <br>';
}

if ($_POST['password_2'] != $_POST['password_1']) {
    $errorUser .= 'Пароли не одинаковы <br>';
}

if (empty($errorUser)) {

    $sql = 'SELECT * FROM users WHERE email = :email LIMIT 1';

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $_POST['login']]);

    if ($stmt->rowCount() == 0) {
        $errorUser .= 'Пользователь не найден. Воспользуйтесь регистрацией';
    } else {

        while ($row = $stmt->fetch()) {
            $id = $row['id'];
            break;
        }

        $sql = 'UPDATE users SET password = :password WHERE id=:id';

        $stmt = $pdo->prepare($sql);

        $result = $stmt->execute([
            'password' => password_hash($_POST['password_1'], PASSWORD_BCRYPT),
            'id' => $id,
        ]);

        if ($result) {
            $titleUser = 'Пароль изменен.<br>Для входа на сайт воспользуйтесь формой авторизации';
            $login = '';
        } else {
            $errorUser = 'Ошибка записи в базу данных.<br>Обратитесь к администратору';
        }
    }
}
