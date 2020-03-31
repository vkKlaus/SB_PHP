<!-- подключаем header -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/header.php'; ?>

<!-- основной блок -->
<main>

    <?php var_dump(session_id()); ?>
    <!-- вызываем процедуру формирования страницы передаем заголовок -->
    <?php viewTxt($mainMenu); ?>

</main>

<!-- подключаем footer -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php';
