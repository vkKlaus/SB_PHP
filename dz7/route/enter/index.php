<?php

require $_SERVER['DOCUMENT_ROOT'] . '/views/header.php';

$autor = false;
$regis = false;
$recov = false;

$login = (empty($_COOKIE['login'])) ? '' : $_COOKIE['login'];
$password = !empty($password) ?: '';
$password_1 = !empty($password_1) ?: '';
$password_2 = !empty($password_2) ?: '';
$user = !empty($user) ?: '';
$phone = !empty($phone) ?: '';
$emailNotification = !empty($emailNotification) ? true : false;

if (isset($_GET['enter'])) {
    switch ($_GET['enter']) {
        case 'autor':
            $autor = true;
            break;
        case 'regis':
            $regis = true;
            break;
        case 'recov':
            $recov = true;
            break;
        case 'exit':
            unset($_SESSION['login']);
            unset($_SESSION['admin']);
            setcookie('login', '', time() - 5);
            require $_SERVER['DOCUMENT_ROOT'] . '/helpers/exit.php';
            break;
    }
}

if (isset($_POST['enter'])) {
    switch ($_POST['enter']) {
        case 'Зарегистрироваться':
            require $_SERVER['DOCUMENT_ROOT'] . '/helpers/registration.php';
            break;
        case 'Войти':
            require $_SERVER['DOCUMENT_ROOT'] . '/helpers/enter.php';
            break;
        case 'Восстановить пароль':
            require $_SERVER['DOCUMENT_ROOT'] . '/helpers/recover.php';
            break;
    }
}
?>

<!-- основной блок -->
<main class="enter-menu">
    <!-- меню -->
    <ul class="horizontal-menu">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/template/enterMenu/templAutorization.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/template/enterMenu/templRegistration.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/template/enterMenu/templRecovPassword.php'; ?>
    </ul>

    <!-- ошибки -->
    <?php if (!empty($errorUser)) { ?>
        <p class="title-enter error-enter">
            <?= $errorUser ?>
        </p>
    <?php } ?>
    <!-- заголовок -->
    <?php if (!empty($titleUser)) { ?>
        <p class="title-enter ">
            <?= $titleUser ?>
        </p>
    <?php } ?>

    <!-- форма -->
    <?php
    if ($autor) {
        require $_SERVER['DOCUMENT_ROOT'] . '/template/enterForm/templAutorizationForm.php';
    } elseif ($recov) {
        require $_SERVER['DOCUMENT_ROOT'] . '/template/enterForm/templRecovPasswordForm.php';
    } elseif ($regis) {
        require $_SERVER['DOCUMENT_ROOT'] . '/template/enterForm/templRegistrationForm.php';
    }
    ?>

</main>

<!-- подключаем footer -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php';
