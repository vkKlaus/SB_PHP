<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>dz-3</title>

  <link rel="stylesheet" href="/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/css/styles.css" />
</head>

<body>

  <?php include_once './viewer/formAutorization.php' ?>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top  d-flex flex-justify-content-between">
      <div class="flex-grow-1  d-flex flex-justify-start">
        <a class="navbar-brand" href="/"> <img src="/img/logo.png" alt="logo" /></a>

        <button class="navbar-toggler text-light" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span>&#9776;</span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ">
            <a class="nav-item nav-link text-light" href="#">Главная </a>

            <a class="nav-item nav-link text-light" href="#">О нас</a>

            <a class="nav-item nav-link text-light" href="#">Контакты</a>

            <a class="nav-item nav-link text-light" href="#">Новости</a>

            <a class="nav-item nav-link text-light" href="#">Каталог</a>
          </div>
        </div>
      </div>

      <div class="text-light">
        <?php if (!$autoOk) : ?>
          <div class="d-flex flex-column">
            <button type="button" class="btn bg-dark text-light" data-toggle="modal" data-target="#exampleModal">
              авторизация | регистрация
            </button>
            <div class="text-center text-danger"> Вы не авторизированы </div>
          </div>
        <?php else : ?>
          <div class="text-success"> пользователь: <?= $userName ?> </div>
        <?php endif ?>

      </div>

    </nav>
  </header>

  <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
  <main class="container ">
    <ul class="nav nav-tabs mt-5 pt-5">
      <li class=" nav-item">
        <a class="nav-link active" data-toggle="tab" href="#mainSection">Главная</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#about">О нас</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#contact">Контакты</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#news">Новости</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#catalog">Каталог</a>
      </li>
    </ul>

    <div class="tab-content px-5 py-5 bg-light">
      <div class="tab-pane fade show active" id="mainSection">
        <h1>Возможности проекта —</h1>

        <p>
          Вести свои личные списки, например покупки в магазине, цели, задачи
          и многое другое. Делится списками с друзьями и просматривать списки
          друзей.
        </p>

        <img src="/img/main.png" alt="mainTab" />
      </div>

      <div class="tab-pane fade" id="about">
        <p>Раздел "О нас"....</p>

        <img src="/img/about.gif" alt="aboutTab" />
      </div>

      <div class="tab-pane fade" id="contact">
        <p>Раздел "Контакты"....</p>
        <img src="/img/contact.jpg" alt="contactTab" />
      </div>

      <div class="tab-pane fade" id="news">
        <p>Раздел "Новости"....</p>
        <img src="/img/news.jpg" alt="newsTab" />
      </div>

      <div class="tab-pane fade" id="catalog">
        <p>Раздел "Каталог"....</p>
        <img src="/img/catalog.png" alt="catalogTab" />
      </div>
    </div>
  </main>


  <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
  <footer class="fixed-bottom bg-dark bg-dark text-light text-center">
    &copy;&nbsp;<nobr>2018</nobr> Project.<br />
  </footer>
  <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
  <script src="/js/jquery-3.4.1.slim.min.js"></script>
  <script src="/js/popper.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script>
    <?php if (isset($errorAuto) && $errorAuto) : ?>
      alert('Ошибка авторизации! Неверный логин или пароль');
    <?php endif ?>
  </script>
</body>

</html>