<pre>
<?php
require_once './db/users.php';
require_once './db/usersPs.php';

$login = '';
$password = '';



if (isset($_POST["autorization"])) {
    $autoOk = false;
    $errorAuto = false;
    $userName = '';
    $login = $_POST["email"];
    $password = $_POST["password"];
    foreach ($userPaswords as $userData) {
        if ($userData['email'] === $_POST["email"] && $userData['password'] === $_POST["password"]) {
            $autoOk = true;

            foreach ($users as $userNames) {
                if ($userData['email']  === $userNames['email']) {
                    $userName = $userNames['name'];
                }
                break;
            }
            break;
        }
    }

    if (!$autoOk) {
        $errorAuto = true;
    }
};

?>

</pre>
<form method="post" action="/">
    <div class="form-group">
        <label for="exampleInputEmail1">Ваш Email </label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value=<?= $login ?>> </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password" value=<?= $password ?>>
    </div>
    <button type="submit" class="btn btn-primary" name="autorization">Выполнить вход...</button>
</form>