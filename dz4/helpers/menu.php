 <?php
 /**
  * функция формирования меню
  * @param string $typeSort вид сортировки (asc - по возрвстанию, dsc - по убыванию)
  * @param string $typeMenu вид меню (используется для формирования класса стиля)
  *
  * @return string $htmlMenu - строка html-кода
  */

 function createMenu(
     string $typeSort = 'asc',
     string $typeMenu = 'horizontal'
 ): string {
     //подключаем файл с массивом меню
     require $_SERVER['DOCUMENT_ROOT'] . '/db/main_menu.php';

     mb_internal_encoding('UTF-8'); //указываем кодировку для сортировки и обрезания
     //сортируем меню
     usort(
         $mainMenu,

         $typeSort == 'asc'
             ? function ($a, $b) {
                 return $a['sort'] > $b['sort']; //сортировка по возрастанию
             }
             : function ($a, $b) {
                 return $b['sort'] > $a['sort']; //сортировка по убыванию
             }
     );

     // $htmlMenu - строка с html-кодом
     $htmlMenu = '<ul class="' . $typeMenu . '-menu">'; //class формируется в зависимости от типа меню

     //обход цикла
     foreach ($mainMenu as $element) {
         $htmlMenu .=
             //пункт списка - раздел меню
             ' 
                <li>       
                    <a href="' .
             $element['path'] .
             '" class="' .
             $typeMenu .
             '-menu-link"> ' . //добавляем ссылку
             '<div class="' .
             $typeMenu .
             '-menu-element ' . //добавляем название
             activePoint($element['path'],'active') . //проверяем активный пункт меню
             '">' .
             cutString($element['title'], 15) . //обрезаем заголовок // обрезаем если более 15 символов
             ' </div>' . //закрываем название
             '</a>' . //закрываем ссылку
             '</li>'; //закрываем пункт меню
     }

     $htmlMenu .= '</ul>'; //закрываем меню

     return $htmlMenu; //возвращаем строку html-кода - сформированное меню
 }
