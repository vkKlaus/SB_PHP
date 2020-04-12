<?php

$errorUser = $titleUser = '';

if (isset($_POST['login'])) {
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

        $users = selectUserGroup($pdo, $_POST['login']);


        if (count($users) == 0) {
            $errorUser .= 'Пользователь не найден. Вход воспрещен!';
        } else {
            if (!password_verify($_POST['password'], $users[0]['password'])) {
                $errorUser .= 'Не верный пароль. Вход воспрещен!';
            } else {
                $titleUser = 'Авторизация выполнена.';
                $_SESSION['login'] = $login;
                $_SESSION['user_id'] = $users[0]['user_id'];

                $_SESSION['profil'] = [
                    'пользователь: ' => $users[0]['user'],
                    'e-mail: ' => $users[0]['email'],
                    'телефон: ' => $users[0]['phone'],
                    'получение уведомления по e-mail: ' => $users[0]['flag_email_notification'],
                ];

                $_SESSION['admin'] = false;
                foreach ($users as $item) {
                    $group[$item['description']] = $item['group_id'];
                    if ($item['group_id'] == '999') {
                        $_SESSION['admin'] = true;
                    }
                }

                $_SESSION['group'] = $group;

                $menuPDO = selectMenu($pdo);
                $mainMenu = [];



                $groupSect = array_filter(
                    $group,
                    function ($element) {
                        return ($element == 3);
                    }
                );

                $groupCrMsg = array_filter(
                    $group,
                    function ($element) {
                        return ($element == 2);
                    }
                );


                foreach ($menuPDO as $item) {

                    if (
                        !$_SESSION['admin']
                        && strpos($item['title'], 'Админ') !== false
                    ) {
                        continue;
                    } elseif (strpos($item['title'], 'Разделы') !== false && (!count($groupSect))) {
                        continue;
                    } elseif (strpos($item['title'], 'Отправить') !== false && (!count($groupCrMsg))) {
                        continue;
                    } elseif (!isset($_SESSION['login']) && strpos($item['title'], 'Главная') !== 0) {
                        continue;
                    }

                    if (isset($_SESSION['login']) && strpos($item['title'], 'Профиль') !== false) {
                        $item['title'] .= ' ' . $_SESSION['login'];
                    }
                    array_push($mainMenu, $item);
                }

                $_SESSION['mainMenu'] = $mainMenu;

                require $_SERVER['DOCUMENT_ROOT'] . '/helpers/exit.php';
            }
        }
    }
}
