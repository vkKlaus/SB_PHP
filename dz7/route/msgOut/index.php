<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/header.php';

$section = 0;
$sectionName = '...';
$title = '';
$text = '';
$linkSections = '/route/msgOut/';
$errorMsg = '';
$checked = [];

if (isset($_SESSION['login'])) {
    $category = selectSection($pdo);


    if (isset($_GET['parent'])) {
        $section = $_GET['parent'];
        $sectionName = $_GET['parentName'];
    }

    if (isset($_POST['btnSubmit'])) {
        $errorMsg = validationMsg($_POST);
        if (!$errorMsg) {
            if (!insertMessage($pdo, $_POST)) {
                $errorMsg = '> ошибка записи в БД <';
            }
        }

        if ($errorMsg) {
            $title = $_POST['title'];
            $text = $_POST['text'];
            $checked = [];
            if (isset($_POST['recepient'])) {
                foreach ($_POST['recepient'] as $id) {
                    $checked[] = $id;
                }
            }
        }
    }
}
?>

<!-- основной блок -->
<main>
    <?php
    if ($errorMsg) {
    ?>

        <p class="title-enter error-enter">
            <?= $errorMsg ?>
        </p>
    <?php
    }
    require $_SERVER['DOCUMENT_ROOT'] . '/template/msg/tempMsgCreate.php';
    ?>
</main>

<!-- подключаем footer -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php';
