<form method="POST" class="enter-form">

    <label class="enter-label" for="login-id">Ваш e-mail:</label>

    <input type="text" name="login" value="<?= $login ?>" id="login-id" class="enter-field">

    <label class="enter-label" for="password-id-1">Новый пароль:</label>

    <input id="password_id" name="password_1" type="password" value="<?= $password_1 ?>" id="password-id-1" class="enter-field" />

    <label class="enter-label" for="password-id-2">повторите пароль:</label>

    <input id="password_id" name="password_2" type="password" value="<?= $password_2 ?>" id="password-id-2" class="enter-field" />

    <input type="submit" value="Восстановить пароль" name="enter" class="enter-button" />

</form>