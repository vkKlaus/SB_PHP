<?php


////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
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

    $result = $stmt->execute();
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

    $result = $stmt->execute();
}

////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

/**  Функция выборки всех пользователей и групп
 * @param object - $pdo объект соединения с БД
 * @return array  - массив - выборка из БД
 */
function selectUserGroup(object $pdo): array
{
    $sql = 'SELECT 
                `users`.id, 
                `users`.user,
                `users`.email, 
                `users`.phone, 
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
    $result = $stmt->execute(['email' => $_SESSION['login']]);

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
    $result = $stmt->execute();
    $resDB = $stmt->fetchAll();

    $category = [];

    foreach ($resDB  as $sectDB) {
        $category[$sectDB['parent_id']][] = $sectDB;
    };

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
    $result = $stmt->execute();

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

    $result = $stmt->execute(
        [
            'name' => $dataArr['subSection'],
            'parent_id' => $dataArr['section'],
            'user_id' => $user_id,
            'color_id' => $dataArr['color']

        ]
    );
}
