<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/header.php';
?>

<!-- основной блок -->
<main>
    <!-- вызываем процедуру формирования страницы передаем заголовок -->
    <?php viewTxt($mainMenu); ?>

    <?php if (empty($_SESSION['login'])) { ?>
        <br>
        <p class="error-load">Вы не авторизированы. Вам доступен просмотр только главной страницы</p>
    <?php } ?>
</main>

<!-- подключаем footer -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php';
