<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/header.php';

?>

<!-- основной блок -->
<main>
    <!-- вызываем процедуру формирования страницы передаем заголовок -->
    <?php viewTxt($mainMenu); ?>
    <?php if (isset($_COOKIE["errorGoTo"]) && $_COOKIE["errorGoTo"]) { ?>
        <br>
        <p class="error-load">Нарушение прав! Переход запрещен!</p>
    <?php } ?>
    <?php if (isAuth()) { ?>
        <br>
        <p class="error-load">Вы не авторизированы. Вам доступен просмотр только главной страницы</p>
    <?php } ?>
</main>

<!-- подключаем footer -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php';
