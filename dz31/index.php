﻿<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link href="/css/styles.css" rel="stylesheet" />
  <title>Project - ведение списков</title>
</head>

<?php
$login = '';
$password = '';
$resAuto = [false, ''];

$openWindowAuto = false;
if (isset($_GET['login']) && $_GET['login'] == 'yes') {
  $openWindowAuto = true;
}

if (isset($_POST['enter'])) {
  $login = $_POST['login'];
  $password = $_POST['password'];
  require_once $_SERVER['DOCUMENT_ROOT'].'/findUser.php';
  $resAuto = findUser($login, $password);
  $openWindowAuto = !$resAuto[0];
}
?>



<body>
  <div class="header">
    <div class="logo">
      <img src="img/logo.png" width="68" height="23" alt="Project" />
    </div>
    <div class="clearfix"></div>
  </div>

  <div class="clear">
    <ul class="main-menu">
      <li><a href="#">Главная</a></li>
      <li><a href="#">О нас</a></li>
      <li><a href="#">Контакты</a></li>
      <li><a href="#">Новости</a></li>
      <li><a href="#">Каталог</a></li>
    </ul>
  </div>

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="left-collum-index">
        <h1>Возможности проекта —</h1>
        <p>
          Вести свои личные списки, например покупки в магазине, цели, задачи
          и многое другое. Делится списками с друзьями и просматривать списки
          друзей.
        </p>
      </td>

      <td class="right-collum-index">
        <?php if ($openWindowAuto) : ?>
          <div class="project-folders-menu">
            <ul class="project-folders-v">
              <li class="project-folders-v-active">
                <a href="#">Авторизация</a>
              </li>
              <li><a href="#">Регистрация</a></li>
              <li><a href="#">Забыли пароль?</a></li>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="index-auth">
            <form action="/?login=yes" method="post">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="iat">
                    <label for="login_id">Ваш e-mail:</label>
                    <input id="login_id" size="30" name="login" value="<?= $login ?>" />
                  </td>
                </tr>
                <tr>
                  <td class="iat">
                    <label for="password_id">Ваш пароль:</label>
                    <input id="password_id" size="30" name="password" type="password" value="<?= $password ?>" />
                  </td>
                </tr>
                <tr>
                  <td><input type="submit" value="Войти" name="enter" />
                    <?php if (!$resAuto[0]) : ?>
                      <p class="errorUser"><?= $resAuto[1] ?> </p>
                    <?php endif; ?></td>
                </tr>
              </table>
            </form>
            <a href="/">
              <div class="winAuto">закрыть окно авторизации</div>
            </a>
          </div>
        <?php else : ?>
          <?php if ($resAuto[0]) : ?>
            <p class="findUser"><?= $resAuto[1] ?> </p>
            <hr>
          <?php endif; ?>
          <a href="/?login=yes">
            <div class="winAuto">
              пройти авторизацию
            </div>
          </a>

        <?php endif; ?>
      </td>

    </tr>
  </table>

  <div class="clearfix">
    <ul class="main-menu bottom">
      <li><a href="#">Главная</a></li>
      <li><a href="#">О нас</a></li>
      <li><a href="#">Контакты</a></li>
      <li><a href="#">Новости</a></li>
      <li><a href="#">Каталог</a></li>
    </ul>
  </div>

  <div class="footer">
    &copy;&nbsp;<nobr>2018</nobr> Project.</div>
</body>

</html>