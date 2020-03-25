<?php
 /**
  * функция обрезания строки
  * @param string $element обрезаемая строка
  * @param string numberOfSymbols количество символов для проверки
  *
  * @return string  обрезанная строка
  */
 function cutString(string $element, int $numberOfSymbols): string
 {
     //возвращаем...
      return mb_strlen($element) <= $numberOfSymbols // проверяем если более .... символов
                 ? $element //не обрезаем
                 : mb_substr($element, 0, $numberOfSymbols-3) . '...'; //обрезаем и добавляем многоточие
 }