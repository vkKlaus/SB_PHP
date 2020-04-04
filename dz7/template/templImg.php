 <div class="docsBox">
     <a data-fancybox="gallery" href="<?= '/img/bigImg/' . $img ?>" class="docsLink">
         <img src="<?= '/img/bigImg/' . $img ?>" alt="$img?" class="docsElement">
     </a>
     <div class="title-img">
         <?= $img ?>
         <label>
             <input type="checkbox" class="check" value="<?= '/img/bigImg/' . $img ?>" name="img[]">
             удалить
         </label>
     </div>
 </div>