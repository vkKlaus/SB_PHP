<?php

require $_SERVER['DOCUMENT_ROOT'] . '/views/header.php';

if (isset($_GET['type']) &&  $_GET['type'] == 'createUsers') {
    createUsers($pdo);
} elseif (isset($_GET['type']) && $_GET['type'] == 'createSection') {
    createSections($pdo);
} elseif (isset($_GET['type']) &&  $_GET['type'] == 'createColor') {
    createColor($pdo);
}



?>

<!-- основной блок -->
<main>
    <!-- вызываем процедуру формирования страницы передаем заголовок -->
    <?php viewTxt($mainMenu); ?>
    <br>
    <ul class="page">
        <li><a href="/route/admin/?type=createUsers" role="button">Создать пользователей</a></li><br>
        <li><a href="/route/admin/?type=createColor" role="button">Создать цвета</a></li><br>
        <li><a href="/route/admin/?type=createSection" role="button">Создать разделы</a></li><br>


    </ul>

</main>

<!-- подключаем footer -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php';
