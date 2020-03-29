<?php
//подключаем header
require $_SERVER['DOCUMENT_ROOT'] . '/views/header.php';

$dirImg = $_SERVER['DOCUMENT_ROOT'] . '/img/bigImg/';

if (isset($_POST['loadImg']) && !empty($_FILES['img']['name'][0])) {
    $countFiles = $_POST['countFiles'] == 0 ? count($_FILES['img']['name']) : $_POST['countFiles'];
    
    for ($i = 0; $i < count($_FILES['img']['name']); $i++) {
    
        if (((bool) $_POST['onlyImg']) && strpos($_FILES['img']['type'][$i],'image') === false){
            continue;
        }

        if (empty($_FILES['img']['error'][$i]) && ($_FILES['img']['size'][$i] <= ($_POST['volFiles']*1000000) || $_POST['volFiles'] == 0)) {
            move_uploaded_file($_FILES['img']['tmp_name'][$i], $dirImg . $_FILES['img']['name'][$i]);
       
            if (--$countFiles <=0 ){
                break;
            }
        }
    }
} 

elseif (isset($_POST['delImg']) && !empty($_POST['img']))
{ 
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

    <form method="POST" action="" enctype="multipart/form-data" class="form">
        <fieldset class="form-container">
            <legend> Загрузите файл(ы) в галерею</legend>

            <div class="form-field">
                <label>
                    макс.объем 1-го файла (mB)<br>
                    <input type="text" name="volFiles" value=0><br>
                    0 - не проверяем
                </label>
                <label>
                    грузим файлов <br>
                    <input type="number" name="countFiles" value=0><br>
                    0 - все что выбрали
                </label>

                <label>
                    только картинки <br>
                    <input type="checkbox" class="check" value="true" name="onlyImg" checked>
                </label>

                <input type="file" name="img[]" accept="image/*" multiple>

                <input type="submit" value="Загрузить" name="loadImg">
            </div>
        </fieldset>
    </form>

    <?php if (scandDirFile($dirImg)) { ?>
        <form class="documents" method="POST" action="">
            <input type="submit" value="Удалить отмеченные" name="delImg">

            <div class="documents">
                <?php
                    $arrImg = scandir($dirImg);
                    delRooDir($arrImg);
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
