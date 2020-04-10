<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/header.php';


$section = 0;
$sectionName = '../';
$subSection = '';
$row = [];


if (isset($_SESSION['login'])) {


    $row = selectUserGroup($pdo);
}
?>

<!-- основной блок -->
<main>
    <!-- вызываем процедуру формирования страницы передаем заголовок -->
    <h3 class="page-header">ПРОФИЛЬ ПОЛЬЗОВАТЕЛЯ</h3>
    <br>

    <?php require $_SERVER['DOCUMENT_ROOT'] . '/template/tempUserProfil.php'; ?>





</main>

<!-- подключаем footer -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php';
