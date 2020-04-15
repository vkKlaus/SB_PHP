   <ul class="<?= $typeMenu ?>-menu">
       <?php foreach ($mainMenu as $element) { ?>
           <li>
               <!-- ссылка -->
               <a href="<?= $element['path'] ?>
               
               " class=" <?= $typeMenu ?>-menu-link">
                   <!-- блок названия  с проверкой на активность-->
                   <div class="<?= $typeMenu ?>-menu-element <?= activePoint($element['path'], 'active') ?>">
                       <?= cutString($element['title'], 150) ?>
                   </div>
               </a>
           </li>
       <?php } ?>
   </ul>