<?php

require $_SERVER['DOCUMENT_ROOT'] . '/views/header.php';

if (isset($_GET['type']) &&  $_GET['type'] == 'createUsers') {
    createUsers($pdo);
} elseif (isset($_GET['type']) && $_GET['type'] == 'createSection') {
    createSections($pdo);
} elseif (isset($_GET['type']) &&  $_GET['type'] == 'createColor') {
    createColor($pdo);
} elseif (isset($_GET['type']) &&  $_GET['type'] == 'createMessage') {
    createMessages($pdo);
}



?>

<!-- основной блок -->
<main>
    <!-- вызываем процедуру формирования страницы передаем заголовок -->
    <?php viewTxt($mainMenu); ?>
    <br>
    <ul class="page">
        <li><a href="/route/admin/?type=createUsers" role="button">Заполнить таблицу пользователей</a></li><br>
        <li><a href="/route/admin/?type=createColor" role="button">Заполнить таблицу цвета</a></li><br>
        <li><a href="/route/admin/?type=createSection" role="button">Заполнить таблицу разделы</a></li><br>
        <li><a href="/route/admin/?type=createMessage" role="button">Заполнить таблицу сообщений</a></li><br>


    </ul>

</main>

<!-- подключаем footer -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php';
