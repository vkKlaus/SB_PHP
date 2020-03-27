<?php

if (isset($_POST['loadImg'])) {
    if (!empty($_FILES['img']['name'][0])) {
        $dirUpload = $_SERVER['DOCUMENT_ROOT'] . '/img/bigImg/';

        for ($i = 0; $i <= count($_FILES['img']['name']);$i++ ){
            if  (empty($_FILES['img']['error'][$i])){
                move_uploaded_file($_FILES['img']['tmp_name'][$i],$dirUpload . $_FILES['img']['name'][$i] );
            }
        }
    }
} 

?>


<!-- подключаем header -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/header.php'; ?>


<!-- основной блок -->
<main>
    <!-- вызываем процедуру формирования страницы передаем заголовок -->
    <?php viewTxt($mainMenu); ?>

    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" class="form">
        <fieldset class="form-container">
            <legend> Загрузите файл(ы) в галерею</legend>
            
            <input type="file" name="img[]" accept="image/*" multiple>
            
            <div class="form-container-button">
                <input type="submit" value="Загрузить" name = "loadImg"> 
            </div>
        </fieldset>
    </form>

    <div class="documents">
        <?php 
        
        $arrImg = (scandir($_SERVER['DOCUMENT_ROOT'] . '/img/bigImg'));
            
        unset($arrImg[0],$arrImg[1]);
                
        foreach ($arrImg as $img){
            require $_SERVER['DOCUMENT_ROOT'] . '/template/templImg.php'; 
        }

        ?>
    </div>

</main>



<!-- подключаем footer -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php';


//   <div class="documents">
//                     <div class="docsBox">
//                         <a data-fancybox="gallery" href="img/doc1.jpg">
//                             <img src="img/doc1.jpg" alt="img1" class="docsElement">
//                         </a>
//                     </div>
//                     <div class="docsBox">
//                         <a data-fancybox="gallery" href="img/doc2.jpg">
//                             <img src="img/doc2.jpg" alt="img2" class="docsElement">
//                         </a>
//                     </div>
//                     <div class="docsBox">
//                         <a data-fancybox="gallery" href="img/doc3.jpg">
//                             <img src="img/doc3.jpg" alt="img3" class="docsElement">
//                         </a>
//                     </div>
//                     <div class="docsBox">
//                         <a data-fancybox="gallery" href="img/doc4.jpg">
//                             <img src="img/doc4.jpg" alt="img4" class="docsElement">
//                         </a>
//                     </div>
//                     <div class="docsBox">
//                         <a data-fancybox="gallery" href="img/doc5.jpg">
//                             <img src="img/doc5.jpg" alt="img5" class="docsElement">
//                         </a>
//                     </div>
//                     <div class="docsBox">
//                         <a data-fancybox="gallery" href="img/doc6.jpg">
//                             <img src="img/doc6.jpg" alt="img6" class="docsElement">
//                         </a>
//                     </div>
//                     <div class="docsBox">
//                         <a data-fancybox="gallery" href="img/doc7.jpg">
//                             <img src="img/doc7.jpg" alt="img7" class="docsElement">
//                         </a>
//                     </div>

//                 </div>
