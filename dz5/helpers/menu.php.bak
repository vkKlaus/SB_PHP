 <?php
 /**
  * функция формирования меню
  * @param array $mainMenu массив с данными меню
  * @param string $typeSort вид сортировки (asc - по возрвстанию, dsc - по убыванию)
  * @param string $typeMenu вид меню (используется для формирования класса стиля)
  */

 function createMenu(
    array $mainMenu,
    string $typeSort = 'asc',
    string $typeMenu = 'horizontal'
 ): string {

     //сортируем меню
    $mainMenu = sortArray($mainMenu,$typeSort);
    
    require $_SERVER['DOCUMENT_ROOT'] . '/template/templMenu.php';    
  
    return '';
 }

