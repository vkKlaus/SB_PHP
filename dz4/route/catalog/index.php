<!-- подключаем header -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/header.php'; ?>

<!-- основной блок -->
<main>
    <!-- вызываем процедуру формирования страницы передаем заголовок -->
    <?php viewTxt() ?>
</main>

<!-- подключаем footer -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php';
