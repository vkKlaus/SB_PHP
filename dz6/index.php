<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/header.php';
$_SESSION['pageMain'] = '+';
?>

<!-- основной блок -->
<main>


    <?php
    var_dump(session_id());
    var_dump($_SESSION);
    ?>
    <!-- вызываем процедуру формирования страницы передаем заголовок -->
    <?php viewTxt($mainMenu); ?>
</main>

<!-- подключаем footer -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php';
