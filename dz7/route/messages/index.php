<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/header.php';


if (isset($_SESSION['user_id'])) {

    $msgIn = selectMsgIn($pdo, $_SESSION['user_id'], true);
    $msgOut = selectMsgOut($pdo, $_SESSION['user_id']);
}
?>

<!-- основной блок -->
<main>
    <h3 class="page-header">СООБЩЕНИЯ ПОЛЬЗОВАТЕЛЯ</h3>
    <br>
    <div class="container-msg">
        <div class="msg">
            <h4 class="page-header">входящие</h4>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/template/msg/tempMsgIn.php'; ?>

        </div>

        <div class="msg">
            <h4 class="page-header">исходящие</h3>
                <?php require $_SERVER['DOCUMENT_ROOT'] . '/template/msg/tempMsgOut.php'; ?>
        </div>


    </div>
</main>

<!-- подключаем footer -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php';
