<?php

require $_SERVER['DOCUMENT_ROOT'] . '/views/header.php';

if (!empty($_GET['type']) && (bool) $_GET['type'] == 'createUsers') {
    $users = [];
    for ($i = 1; $i < 10; $i++) {
        $user = [
            'user' => 'us' . $i * 10,
            'email' => 'us' . $i . '@' . $i . '.dz7',
            'phone' => '' . $i . $i . $i . ' - ' . $i . $i . ' - ' . $i . $i,
            'password' => password_hash('' . $i . $i . $i, PASSWORD_BCRYPT),
            'flag_email_notification' => true,
            'flag_active' => 0,
        ];

        $sql = 'SELECT * FROM users WHERE email = :email LIMIT 1';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $user['email']]);

        if ($stmt->rowCount() !== 0) {
            continue;
        } else {
            $sql = 'INSERT INTO users 
            (
                user, 
                email, 
                phone, 
                password, 
                flag_email_notification, 
                flag_active
            ) 
            values 
            (
                :user, 
                :email, 
                :phone, 
                :password,
                :flag_email_notification,
                :flag_active
            )';
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute($user);

            $sql = 'SELECT users.id, group_user.user_id, group_user.group_id 
        FROM users 
        LEFT OUTER JOIN group_user 
        ON users.id = group_user.user_id  
        WHERE users.email=:email';

            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $user['email']]);

            $flag = true;
            $id = null;
            while ($row = $stmt->fetch()) {
                if ($row['group_id'] == '1') {
                    $flag = false;
                    break;
                } else {
                    $id = $row['id'];
                }
            }

            if ($flag) {
                $sql = 'INSERT INTO group_user 
            (
                user_id, 
                group_id
            ) 
            values 
            (
                :user_id, 
                :group_id
                )';

                $stmt = $pdo->prepare($sql);
                $stmt->execute(['user_id' => $id, 'group_id' => 1]);
            }
        }
    }
}


?>

<!-- основной блок -->
<main>
    <!-- вызываем процедуру формирования страницы передаем заголовок -->
    <?php viewTxt($mainMenu); ?>

    <ul class="page">
        <li><a href="/route/admin/?type=createUsers" role="button">Создать пользователей</a></li>
    </ul>

</main>

<!-- подключаем footer -->
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php';
