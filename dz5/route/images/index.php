<?php
//подключаем header
require $_SERVER['DOCUMENT_ROOT'] . '/views/header.php';

$dirImg = $_SERVER['DOCUMENT_ROOT'] . '/img/bigImg/';

$volFiles = 0;
$countFiles = 0;
$onlyImg = true;

$errorTitle = '';


if (isset($_POST['loadImg']) && !empty($arrName[0])) {


    $arrName = $_FILES['img']['name'];
    $arrType = $_FILES['img']['type'];
    $arrSize = $_FILES['img']['size'];
    $arrTmp = $_FILES['img']['tmp_name'];
    $arrError = $_FILES['img']['error'];

    //проверяем количество файлов к загрузке
    if ($_POST['countFiles'] < count($arrName) && $_POST['countFiles'] != 0) {

        $errorTitle .= 'Для загрузки разрешено ' . $_POST['countFiles']
            . ' фл. Выбрано ' . count($arrName) . '<br>';
    }

    //проверяем тип файлов к загрузке
    if ((bool) $_POST['onlyImg']) {
        $arrayNoImg = array_filter(
            $arrType,
            function ($fileType) {
                return  mb_strpos($fileType, 'image') === false;
            }
        );

        if (count($arrayNoImg) != 0) {
            $errorTitle .=  'К загрузке разрешены только картинки. 
                            Выбрано не картинок: ' . count($arrayNoImg) . '<br>';
        }
    }

    //проверяем размеры фалов
    if ($_POST['volFiles'] != 0) {
        $arrayNoSize = array_filter(
            $arrSize,
            function ($fileSize) {
                return  $fileSize > ($_POST['volFiles'] * 1000000);
            }
        );

        if (count($arrayNoSize) != 0) {
            $errorTitle .= 'К загрузке разрешены только файлы размером меньше ' . $_POST['volFiles'] . 'mB.
                           Не подходят: ' . count($arrayNoSize) . '<br>';
        }
    }



    //если не ошибок - грузим
    if (empty($errorTitle)) {

        for ($i = 0; $i < count($arrName); $i++) {
            move_uploaded_file($arrTmp[$i], $dirImg . $arrName[$i]);
        }
    } else {

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

                <input type="file" name="img[]" accept="image/jpeg, image/jpg, image/png" multiple>

                <input type="submit" value="Загрузить" name="loadImg">
            </div>
        </fieldset>
    </form>

    <!--  ecли ошибки - выводим сообщение -->
    <?php if (!empty($errorTitle)) { ?>
        <h3 class="error-title">ОШИБКА:</h3>

        <p class="error-load"> <?= ($errorTitle) ?></p> <br>
    <?php } ?>



    <?php if (scanDirFile($dirImg)) { ?>
        <form class="documents" method="POST">
            <input type="submit" value="Удалить отмеченные" name="delImg">

            <div class="documents">
                <?php

                $arrImg = delRootDir(scandir($dirImg));

                foreach ($arrImg as $img) {
                    if (mb_strpos(mime_content_type($dirImg . $img), 'image') === 0) {
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
