<?php
//подключаем header
require $_SERVER['DOCUMENT_ROOT'] . '/views/header.php';

$dirImg = $_SERVER['DOCUMENT_ROOT'] . '/img/bigImg/';

$volFiles = 0;
$countFiles = 0;
$onlyImg = true;

if (isset($_POST['loadImg']) && !empty($_FILES['img']['name'][0])) {

    $errorLoad = false;
    $errorCount = '';
    $errorType = '';

    //проверяем возможность загрузки
    $canLoad = checlLoad($_POST['countFiles'], (bool) $_POST['onlyImg'], $_FILES['img']['type']);

    if ($canLoad['load']) {

        for ($i = 0; $i < count($_FILES['img']['name']); $i++) {
            if (empty($_FILES['img']['error'][$i]) && ($_FILES['img']['size'][$i] <= ($_POST['volFiles'] * 1000000) || $_POST['volFiles'] == 0)) {
                move_uploaded_file($_FILES['img']['tmp_name'][$i], $dirImg . $_FILES['img']['name'][$i]);
            }
        }
    } else {
        $errorLoad = true;
        if ($canLoad['errorCount'] != 0) {
            $errorCount = 'Для загрузки разрешено ' . $_POST['countFiles'] . ' фл. Выбрано ' . count($_FILES['img']['name']);
        }

        if ($canLoad['errorType'] != 0) {
            $errorType = 'К загрузке разрешены только картинки. Выбрано не картинок: ' . $canLoad['errorType'];
        }

        $volFiles = $_POST['volFiles'];
        $countFiles = $_POST['countFiles'];
        $onlyImg = $_POST['onlyImg'];
    }
} elseif (isset($_POST['delImg']) && !empty($_POST['img'])) {
    foreach ($_POST['img'] as $item) {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $item)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $item);
        }
    }
}
?>

<!-- основной блок -->
<main>
    <!-- вызываем процедуру формирования страницы передаем заголовок -->
    <?php viewTxt($mainMenu); ?>

    <form method="POST" enctype="multipart/form-data" class="form">
        <fieldset class="form-container">
            <legend> Загрузите файл(ы) в галерею</legend>

            <div class="form-field">
                <label>
                    макс.объем 1-го файла (mB)<br>
                    <input type="text" name="volFiles" value="<?= $volFiles ?>"><br>
                    0 - не проверяем
                </label>

                <label>
                    грузим файлов <br>
                    <input type="number" name="countFiles" value=<?= $countFiles ?>><br>
                    0 - все что выбрали
                </label>

                <label>
                    только картинки <br>
                    <input type="checkbox" class="check" value="<?= $onlyImg ? 'true' : 'false' ?>" name="onlyImg" <?= $onlyImg ? 'checked' : '' ?>>
                </label>

                <input type="file" name="img[]" accept="image/*" multiple>

                <input type="submit" value="Загрузить" name="loadImg">
            </div>
        </fieldset>
    </form>


    <?php if ($errorLoad) { ?>
        <h3 class="error-title">ОШИБКА:</h3>

        <p class="error-load"> <?= ($errorCount) ?></p> <br>

        <p class="error-load"><?= ($errorType) ?> </p> <br>
    <?php } ?>



    <?php if (scandDirFile($dirImg)) { ?>
        <form class="documents" method="POST">
            <input type="submit" value="Удалить отмеченные" name="delImg">

            <div class="documents">
                <?php
                $arrImg = scandir($dirImg);

                $arrImg = delRootDir($arrImg);

                foreach ($arrImg as $img) {
                    if (strpos(mime_content_type($dirImg . $img), 'image') === 0) {
                        require $_SERVER['DOCUMENT_ROOT'] . '/template/templImg.php';
                    }
                }
                ?>
            </div>
        </form>
    <?php } ?>
</main>

<!-- подключаем footer -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php';
