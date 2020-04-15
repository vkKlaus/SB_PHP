<?php
if (isset($msgOut)) {
    if (count($msgOut) > 0) {
        $msgId = -1;
        foreach ($msgOut as $msg) {
            if ($msgId != $msg['id']) {
                $msgId = $msg['id'] ?>

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

                <div class="recipient-msg">получатели:</div>

                <span class="recipient-msg"> <?= $msg['userName'] ?>;</span>

            <?php } else { ?>

                <span class="recipient-msg"> <?= $msg['userName'] ?>;</span>
    <?php }
        }
    }
} else { ?>
    <div> Список исходящих сообщений пуст!</div>
<?php } ?>