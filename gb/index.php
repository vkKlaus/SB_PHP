<?php
 ///////////////////////////////////////////////////////////////////////////////////////////////
function addImgPHP ( $name ){
 //  echo  '<script type="text/javascript">addImg ( $name )</script>';
 } 

///////////////////////////////////////////////////////////////////////////////////////////////
function transString ( $row ){
    $transLetter = ['а' => 'a' , 'б' => 'b' , 'в' => 'v' , 'г' => 'g' , 'д' => 'd' , 'е' => 'e' , 'ё' => 'e' , 'ж' => 'j' , 'з' => 'z' , 'и' => 'i' , 'й' => 'i' , 'к' => 'k' , 'л' => 'l' , 'м' => 'm' , 'н' => 'n' , 'о' => 'o' , 'п' => 'p' , 'р' => 'r' , 'с' => 's' , 'т' => 't' , 'у' => 'u' , 'ф' => 'f' , 'х' => 'h' , 'ц' => 'c' , 'ч' => 'ch' , 'ш' => 'sh' , 'щ' => 'sc' , 'ъ' => '' , 'ы' => 'y' , 'ь' => '' , 'э' => 'e' , 'ю' => 'iu' , 'я' => 'ia' , 'А' => 'A' , 'Б' => 'B' , 'В' => 'V' , 'Г' => 'G' , 'Д' => 'D' , 'Е' => 'E' , 'Ё' => 'E' , 'Ж' => 'J' , 'З' => 'Z' , 'И' => 'I' , 'Й' => 'I' , 'К' => 'K' , 'Л' => 'L' , 'М' => 'M' , 'Н' => 'N' , 'О' => 'O' , 'П' => 'P' , 'Р' => 'R' , 'С' => 'S' , 'Т' => 'T' , 'У' => 'U' , 'Ф' => 'F' , 'Х' => 'H' , 'Ц' => 'C' , 'Ч' => 'Ch' , 'Ш' => 'Sh' , 'Щ' => 'Sc' , 'Ъ' => '' , 'Ы' => 'Y' , 'Ь' => '' , 'Э' => 'E' , 'Ю' => 'Iu' , 'Я' => 'Ia' , ' ' => '_'
    ];
     
    return strtr ( $row , $transLetter );

}

///////////////////////////////////////////////////////////////////////////////////////////////
function copySmallFIle ( $src , $type , $name ){

    list ( $w , $h ) = getimagesize ( $src );

    $percent=  ( 300 / $w  );

    $new_w =  ( int ) ( $w * $percent );
    $new_h =  ( int ) ( $h * $percent );

    $newImg = imagecreatetruecolor ( $new_w , $new_h );

    switch  ( $type ){
       case 'image/png':
           $img = imagecreatefrompng ( $src );
           imagecopyresampled  ( $newImg , $img , 0 , 0 , 0 , 0 , $new_w , $new_h , $w , $h  );
           imagepng  ( $newImg , "images/small/".$name );
            
            addImgPHP ( $name );   
           break;

       case 'image/jpg':
           $img = imagecreatefromjpeg ( $src );
           imagecopyresampled  ( $newImg , $img , 0 , 0 , 0 , 0 , $new_w , $new_h , $w , $h );
           imagejpeg  ( $newImg , "images/small/".$name );
            addImgPHP  ( $name ); 
           break;

       case 'image/jpeg':
           $img = imagecreatefromjpeg ( $src );
           imagecopyresampled ( $newImg , $img  , 0 , 0 , 0 , 0 , $new_w , $new_h  , $w , $h );
           imagejpeg ( $newImg , "images/small/".$name );
            addImgPHP ( $name ); 
           break;

       case 'image/jpeg':
           $img = imagecreatefromgif ( $src );
           imagecopyresampled ( $newImg , $img  , 0 , 0 , 0 , 0 , $new_w , $new_h  , $w , $h );
           imagegif ( $newImg , "images/small/".$name );
             addImgPHP ( $name ); 
           break;
       default:
           break;
    }
    
       

}

///////////////////////////////////////////////////////////////////////////////////////////////
    $dirBig='images/';
    $dirSmall='images/small/';

    $fileBig=array_slice ( scandir ( $dirBig ) , 2 );
    $fileSmall=array_slice ( scandir ( $dirSmall ) , 2 );
  
    $listImg='';
    foreach  ( $fileSmall as $img ){
        
        $listImg=$listImg.'<div class="docsBox"> 
        <a data-fancybox="gallery" href="'.$dirBig.$img.'">
        <img src="'.$dirSmall.$img.'" alt="$img" class="docsElement">
        </a></div>';
     
    }

///////////////////////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>DZ-4</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css" />
   
    <style type="text/css">
        <? include "style.css"?>
    </style>
    
   
</head>

<body>
    <div id="containerHeader">
        <h1>Моя галерея</h1>
   
        <form method="POST" action="" enctype="multipart/form-data">
            <p> Загрузите файл ( ы ) в галерею</p>
            <input type="file" name="img[]" accept="image/*" multiple>
            <input type="submit" value="Загрузить">
           <button onclick="addImg ( $name )">Обновить</button>
        </form>
        
        <?php
            $items = count ( $_FILES["img"]["name"] ) ;

            for  ( $i = 0; $i < $items; $i++  ){
       
               $bigFileName = transString ( $_FILES["img"]["name"][$i] );
               $bigFile = transString ( "images/".$bigFileName );
               if  ( move_uploaded_file ( $_FILES["img"]["tmp_name"][$i] , $bigFile ) ){
                    copySmallFIle ( $bigFile , $_FILES["img"]["type"][$i] , $bigFileName ); 
                 }; 
            }; 
        ?>

    </div>

    <div class="documents">
        <?=$listImg ?>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
    
     <script type='text/javascript'>
         
         function addImg ( imgFile ){
  
            let img_el = document.createElement ( 'img' );
            img_el.setAttribute ( 'src' , 'images/small/' + imgFile );
            img_el.setAttribute ( 'alt' , imgFile );
            img_el.classList.add ( 'docsElement' );
            var a_el = document.createElement ( 'a' );
            a_el.setAttribute ( 'href' , 'images/' + imgFile );
            a_el.setAttribute ( 'data-fancybox' , 'gallery' );
            a_el.appendChild ( img_el );
            var div_el = document.createElement ( 'div' );
            div_el.classList.add ( 'docsBox' );
            div_el.appendChild ( a_el );
            document.getElementsByClassName ( 'documents' )[0].appendChild ( div_el );
        }
         
         
    </script>
</body>

</html>