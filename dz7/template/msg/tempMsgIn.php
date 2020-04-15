<?php
if (isset($msgIn)) {
    if (count($msgIn) > 0) {
        foreach ($msgIn as $msg) { ?>
            <div class="block-msg"> <?= $msg['msg_title'] ?></div>
            <div class="msg-info">
                <div style="color:rgb(<?= $msg['red'] ?>,
                                    <?= $msg['green'] ?>,
                                    <?= $msg['blue'] ?>)">
                    раздел: <?= $msg['sect_name'] ?>
                </div>

                <div><?= $msg['msg_date'] ?></div>
            </div>

            <div style="background-color:rgb(<?= $msg['red'] / 2 + 100 ?>,
                                            <?= $msg['green'] / 2 + 100 ?>,
                                            <?= $msg['blue'] / 2 + 100 ?>)">
                <?= $msg['msg_text'] ?>
            </div>

            <div class="recipient-msg">отправитель:</div>

            <span class="recipient-msg"> <?= $msg['userName'] ?>;</span>


    <?php }
    }
} else { ?>
    <div> Список входящих сообщений пуст!</div>
<?php } ?>