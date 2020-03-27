<!-- подключаем header -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/views/header.php'; ?>

<!-- основной блок -->
<main>
       <!-- вызываем процедуру формирования страницы передаем заголовок -->
       <?php viewTxt($mainMenu); ?>
</main>

<!-- подключаем footer -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php';
