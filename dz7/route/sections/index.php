<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/header.php';

$section = 0;
$sectionName = '../';
$subSection = '';
$linkSections = '/route/sections/';


if (isset($_SESSION['login'])) {

    $userID = selectUserGroup($pdo)[0]['id'];
    $category = selectSection($pdo);

    $colorsDB = selectColor($pdo);

    if (isset($_GET['parent'])) {
        $section = $_GET['parent'];
        $sectionName = $_GET['parentName'];
    }

    if (isset($_GET['clearSection'])) {
        $section = 0;
        $sectionName = '../';
    }

    if (isset($_POST['subSection'])) {
        insertSection($pdo, $_POST, $userID);
        $category = selectSection($pdo);
    }
}
?>

<!-- основной блок -->
<main>
    <h3 class="page-header">РАЗДЕЛЫ И ПОДРАЗДЕЛЫ</h3>
    <br>
    <div class="form-section">

        <?php require $_SERVER['DOCUMENT_ROOT'] . '/template/tempCreateSection.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/template/tempUserSection.php'; ?>
    </div>
</main>

<!-- подключаем footer -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php';
