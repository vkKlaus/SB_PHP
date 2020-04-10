<div class="user-profil">
    <div class="user-data">
        <h3>информация:</h3>

        <ul>
            <li>
                <?= 'пользователь: ' . $row[0]['user'] ?>
            </li>

            <li>
                <?= 'e-mail: ' . $row[0]['email'] ?>
            </li>

            <li>
                <?= 'телефон: ' . $row[0]['phone'] ?>
            </li>

            <li>
                <?= 'получение уведомления по e-mail: ' . ($row[0]['flag_email_notification'] ? 'ДА' : 'НЕТ') ?>
            </li>
        </ul>
    </div>

    <div class="user-data">
        <h3>входит в группы:</h3>

        <ul>
            <?php foreach ($row as $value) { ?>
                <li>
                    <?= $value['description'] ?>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>