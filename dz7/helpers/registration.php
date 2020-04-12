<?php
$errorUser = $titleUser = '';

$login = $_POST['login'];

if (empty($_POST['login'])) {
    $errorUser .= 'Поле e-mail не может быть пустым <br>';
} elseif (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
    $errorUser .= "E-mail адрес '$login' указан не верно.<br>";
}

if (empty($_POST['user'])) {
    $errorUser .= 'Поле имя не может быть пустым <br>';
}

if (empty($_POST['password_1'])) {
    $errorUser .= 'Поле пароль  не может быть пустым <br>';
}

if ($_POST['password_2'] != $_POST['password_1']) {
    $errorUser .= 'Пароли не одинаковы <br>';
}


if (!empty($errorUser)) {
    $login = $_POST['login'];
    $user = $_POST['user'];
    $phone = $_POST['phone'];
    $emailNotification = !empty($_POST['emailNotification']) ? true : false;
} else {

    $sql = 'SELECT * FROM users WHERE email = :email LIMIT 1';

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $_POST['login']]);

    if ($stmt->rowCount() !== 0) {
        $errorUser .= 'Пользователь уже зарегистрирован. Воспользуйтесь авторизацией';
    } else {
        $sql = 'INSERT INTO users 
                    (
                        user,
                        email,
                        phone,
                        password,
                        flag_email_notification,
                        flag_active
                    ) 
                    values 
                    (
                        :user, 
                        :email,
                        :phone, 
                        :password, 
                        :flag_email_notification, 
                        :flag_active
                        )';

        $stmt = $pdo->prepare($sql);

        $result = $stmt->execute(
            [
                'user' => $_POST['user'],
                'email' => $_POST['login'],
                'phone' => empty($_POST['phone']) ? null : (int) $_POST['phone'],
                'password' => password_hash($_POST['password_1'], PASSWORD_BCRYPT),
                'flag_email_notification' => !empty($_POST['emailNotification']) ? 1 : 0,
                'flag_active' => 0,
            ]
        );

        if ($result) {
            $titleUser = 'Пользователь зарегистрирован.<br>Для входа на сайт воспользуйтесь формой авторизации';
            $login =  $user = $phone = '';
            $emailNotification =  true;
        } else {
            $errorUser = 'Ошибка записи в базу данных.<br>Обратитесь к администратору';
        }
    }
}
