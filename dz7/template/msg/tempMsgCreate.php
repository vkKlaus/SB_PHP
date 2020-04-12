<?php

$users = selectUsers($pdo);

$users = array_filter(
    $users,
    function ($element) {
        return $element['id'] !== $_SESSION['user_id'];
    }
);

array_unshift($users, ['id' => -1, 'user' => 'все', 'email' => '-----']);

?>

<div class="container-msg">
    <div>
        <h3 class="page-header">РАЗДЕЛЫ И ПОДРАЗДЕЛЫ</h3>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/template/tempUserSection.php'; ?>
    </div>

    <form action="" method="POST" class="form-msg">
        <div class="container-msg">
            <div class="input-msg">
                <h3 class="page-header">СООБЩЕНИЕ</h3>

                <label class="enter-label" for="section">Раздел: <smal>*(выберите раздел в левом блоке)</smal></label>

                <input type="text" name="section" style="display:none" value="<?= $section ?>" id="section">

                <div class="block-section">
                    <div class="section-name"> <?= $sectionName ?></div>

                    <a href="/route/msgOut/?clearSection=1" class="cross-clear">
                        Х
                    </a>
                </div>


                <label class="enter-label" for="msg-title">Заголовок:</label>

                <input type="text" id="msg-title" name="title" value="<?= $title ?>">

                <label class="enter-label" for="msg-text">Текст сообщения:</label>

                <textarea class="text-msg" id="msg-text" name="text"> <?= htmlspecialchars($text) ?></textarea>
            </div>

            <div class="input-msg">
                <h3 class="page-header">ПОЛУЧАТЕЛИ</h3>

                <ul class="user-list">
                    <?php
                    foreach ($users as $user) { ?>

                        <li class="user-list-element">
                            <input type="checkbox" class="check-user" name="recepient[]" value="<?= $user['id'] ?>" <?php if (in_array($user['id'], $checked)) { ?> checked <?php } ?>>

                            <span><?= $user['user'] ?></span>
                        </li>

                    <?php } ?>
                </ul>
            </div>

        </div>
        <input type="submit" name="btnSubmit" value="Отправить" class="enter-button" />
    </form>
</div>