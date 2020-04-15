<?php


////////////////////////////////////////////////////////////////////////////////////////////
//         служебные функции                                                              //
////////////////////////////////////////////////////////////////////////////////////////////

/**СЛУЖЕБНЫЕ МОДУЛИ. СПОЛЬЗУЮТЯ ИСКЛЮЧИТЕЛЬНО ДЛЯ ОТЛАДКИ, ЧТОБЫ НЕ ЗАБИВАТЬ ПЕВОНАЧАЛЬНЫЕ ДАННЫЕ РУКАМИ
 */
/** функция создания users без admin */
function createUsers($pdo)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/db/PDOuser.php';

    foreach ($users as $user) {

        $sql = 'SELECT * FROM users WHERE email = :email LIMIT 1';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $user['email']]);

        if ($stmt->rowCount() == 0) {

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
            $stmt->execute($user);

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

/** функция заполнения разделов */
function createSections($pdo)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/db/PDOsection.php';

    $sql = 'INSERT INTO sections 
                (
                    id,
                    name,
                    parent_id,
                    user_id,
                    color_id
                ) 
                values ';

    foreach ($sections as $section) {
        $sql .= '
                ("' .
            $section['id'] . '","' .
            $section['name'] . '","' .
            $section['parent_id'] . '","' .
            $section['user_id'] . '","' .
            $section['color_id'] . '"
                ),';
    }

    $sql .= '~';
    $sql = str_replace(',~', '', $sql);


    $stmt = $pdo->prepare($sql);

    $stmt->execute();
}

/** функция заполнения цветов */
function createColor($pdo)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/db/PDOcolor.php';

    $sql = 'INSERT INTO colors 
            (
                id,
                name,
                red,
                green,
                blue
            ) 
            values ';

    foreach ($colors as $color) {
        $sql .= '
                ("' .
            $color['id'] . '","' .
            $color['name'] . '",' .
            $color['red'] . ',' .
            $color['green'] . ',' .
            $color['blue'] . '
                ),';
    }

    $sql .= '~';
    $sql = str_replace(',~', '', $sql);

    $stmt = $pdo->prepare($sql);

    $stmt->execute();
}

/** функция заполнения сообщений и рассылки */
function createMessages($pdo)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/db/PDOmessages.php';



    //сообщения
    $sql = 'INSERT INTO messages 
            (
                title,
                text,
                user_id_sender,
                section_id
            ) 
            values ';

    foreach ($messages as $message) {
        $sql .= '
                ("' .
            $message['title'] . '","' .
            $message['text'] . '",' .
            $message['user_id_sender'] . ',' .
            $message['section_id'] .
            '),';
    }

    $sql .= '~';
    $sql = str_replace(',~', '', $sql);


    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // рассылка
    $sql = 'INSERT INTO message_recipient 
            (
                message_id,
                recipient_user_id
            ) 
            values ';

    foreach ($user_recepient as $recepient) {

        $sql .= '
                (' .
            $recepient['message_id'] . ',' .
            $recepient['recipient_user_id']  .
            '),';
    }

    $sql .= '~';
    $sql = str_replace(',~', '', $sql);

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////


/**  Функция выборки всех пользователей 
 * @param object - $pdo объект соединения с БД
 * @return array  - массив - выборка из БД
 */
function selectUsers(object $pdo): array
{
    $sql = 'SELECT 
            id, 
            user,
            email 
            FROM `users`';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll();
}

/**  Функция выборки информации о  пользователе и группах
 * @param object - $pdo объект соединения с БД
 * @param string - $email login пользователя
 * @return array  - массив - выборка из БД
 */
function selectUserGroup(object $pdo, string $email = null): array
{
    $sql = 'SELECT 
                `users`.id, 
                `users`.user,
                `users`.email, 
                `users`.phone, 
                `users`.password, 
                `users`.flag_email_notification,
                `group_user`.user_id,
                `group_user`.group_id,
                `groups`.description
            FROM `users` 
            LEFT OUTER JOIN `group_user` 
            ON `users`.id = `group_user`.user_id  
            LEFT OUTER JOIN `groups` 
            ON `groups`.id = `group_user`.group_id  
            WHERE `users`.email=:email';

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => ($email == null && isset($_SESSION['login']) ?
        $_SESSION['login']
        : $email)]);

    return $stmt->fetchAll();
}

/**  Функция выборки соединения: раздел, цвет, пользователь создавший раздел
 * @param object - $pdo объект соединения с БД
 * @return array  - массив - преобразованная выборка из БД. 
 *                           массив подготовлен для вывода в рекурсивной функции
 */
function selectSection(object $pdo): array
{
    $sql = 'SELECT 
                `sections`.id AS sections_id, 
                `sections`.name,
                `sections`.parent_id, 
                `sections`.user_id, 
                `sections`.color_id,
                `colors`.red,
                `colors`.green,
                `colors`.blue,
                `users`.email
            FROM `sections` 
            LEFT OUTER JOIN `colors` 
            ON `sections`.color_id = `colors`.id 
            LEFT OUTER JOIN `users` 
            ON `sections`.user_id = `users`.id
            ORDER BY `sections`.parent_id';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resDB = $stmt->fetchAll();

    $category = [];

    foreach ($resDB  as $sectDB) {
        $category[$sectDB['parent_id']][] = $sectDB;
    }

    return $category;
}

/**  Функция выборки цветов 
 * @param object - $pdo объект соединения с БД
 * @return array  - массив - выборка из БД
 */
function selectColor(object $pdo): array
{
    $sql = 'SELECT id,name FROM `colors` ';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll();
}

/**  Функция выборки menu 
 * @param object - $pdo объект соединения с БД
 * @return array  - массив - выборка из БД
 */
function selectMenu(object $pdo): array
{
    $sql = 'SELECT title, path, id as sort, group_id 
        FROM main_menu 
        WHERE use_panel=1 ';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

/**  Функция добавления секции 
 * @param object - $pdo объект соединения с БД
 * @param array  - ассоц.массив добавляемых данных
 * @param int  - id текущего пользователя
 */
function insertSection(object $pdo, array $dataArr, int $user_id)
{
    $sql = 'INSERT INTO sections 
                (
                    name,
                    parent_id,
                    user_id,
                    color_id
                )
            VALUES
                (
                    :name, 
                    :parent_id,
                    :user_id,
                    :color_id
            )';

    $stmt = $pdo->prepare($sql);

    $stmt->execute(
        [
            'name' => $dataArr['subSection'],
            'parent_id' => $dataArr['section'],
            'user_id' => $user_id,
            'color_id' => $dataArr['color']
        ]
    );
}

/**  Функция получения входящих сообщений
 * @param object - $pdo объект соединения с БД
 * @param int - id текущего пользователя
 * @return array массив входящих сообщения
 */
function selectMsgIn(object $pdo, int $user_id): array
{

    $sql = 'SELECT
                `messages`.id,
                `messages`.title as msg_title,
                `messages`.section_id,
                `messages`.date_time as msg_date,
                `messages`.text as msg_text,
                `messages`.user_id_sender as sender,
                `message_recipient`.recipient_user_id as recipient,
                `users`.user as userName,
                `users`.email as email,
                `sections`.name as sect_name,
                `sections`.color_id,
                `colors`.red as red,
                `colors`.green as green,
                `colors`.blue as blue
            FROM `messages`
            LEFT OUTER JOIN `message_recipient` ON `message_recipient`.message_id = `messages`.id
            LEFT OUTER JOIN `users` ON `users`.id = `messages`.user_id_sender
            LEFT OUTER JOIN `sections` ON `messages`.section_id = `sections`.id
            LEFT OUTER JOIN `colors` ON  `sections`.color_id = `colors`.id
            WHERE `message_recipient`.recipient_user_id = :user_id
            ORDER BY `messages`.date_time DESC, `users`.user, `messages`.id';


    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);

    return $stmt->fetchAll();
}

/**  Функция получения исходящих сообщений
 * @param object - $pdo объект соединения с БД
 * @param int - id текущего пользователя
 * @return array массив входящих сообщения
 */
function selectMsgOut(object $pdo, int $user_id): array
{
    $sql = 'SELECT
                `messages`.id,
                `messages`.title as msg_title,
                `messages`.section_id,
                `messages`.date_time as msg_date,
                `messages`.text as msg_text,
                `messages`.user_id_sender as sender,
                `message_recipient`.recipient_user_id as recipient,
                `users`.user as userName,
                `users`.email as email,
                `sections`.name as sect_name,
                `sections`.color_id,
                `colors`.red as red,
                `colors`.green as green,
                `colors`.blue as blue
            FROM `messages`
            LEFT OUTER JOIN `message_recipient` ON `message_recipient`.message_id = `messages`.id
            LEFT OUTER JOIN `users` ON `users`.id = `message_recipient`.recipient_user_id
            LEFT OUTER JOIN `sections` ON `messages`.section_id = `sections`.id
            LEFT OUTER JOIN `colors` ON  `sections`.color_id = `colors`.id
            WHERE `messages`.user_id_sender = :user_id
            ORDER BY `messages`.date_time DESC, `messages`.id, `users`.user, `messages`.id';

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);

    return $stmt->fetchAll();
}

/**  Функция добавления нового сообщения
 * @param object - $pdo объект соединения с БД
 * @param array - $msg массив с данными сообщения
 * @return bool - результат 
 */
function  insertMessage(object $pdo, array $msg): bool
{
    //запись сообщения
    $sql = 'INSERT INTO messages 
                (
                    title,
                    section_id,
                    text,
                    user_id_sender
                )
            VALUES
                (
                    :title, 
                    :section_id,
                    :text,
                    :user_id_sender
            )';

    $stmt = $pdo->prepare($sql);

    $result = $stmt->execute(
        [
            'title' => $msg['title'],
            'section_id' => (int) $msg['section'],
            'text' => $msg['text'],
            'user_id_sender' => $_SESSION['user_id']
        ]
    );

    if (!$result) {
        return false;
    }

    $sql = 'SELECT LAST_INSERT_ID() as id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $id = $stmt->fetch()['id'];

    //проверяем раасылку ВСЕ
    $users = [];

    if (in_array(-1, $msg['recepient'])) {
        $users = selectUsers($pdo);
        $users = array_filter(
            $users,
            function ($element) {
                return $element['id'] !== $_SESSION['user_id'];
            }
        );
        $msg['recepient'] = [];
        foreach ($users as $user) {
            $msg['recepient'][] = $user['id'];
        }
    }

    //записывем рассылку
    $sql = 'INSERT INTO message_recipient 
                (
                    message_id,
                    recipient_user_id
                )
            VALUES';

    foreach ($msg['recepient'] as $recId) {
        $sql .= '(' . $id . ',' . $recId . '),';
    }

    $sql .= '~';
    $sql = str_replace(',~', '', $sql);

    $stmt = $pdo->prepare($sql);

    return $stmt->execute();
}
