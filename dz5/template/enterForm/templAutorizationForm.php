<form method="POST" class="enter-form">

    <label class="enter-label" for="login-id">Ваш e-mail:</label>

    <input type="text" name="login" value="<?= $login ?>" id="login-id" class="enter-field">

    <label class="enter-label" for="password-id">Ваш пароль:</label>

    <input id="password_id" name="password" type="password" value="<?= $password ?>" id="password-id" class="enter-field" />

    <input type="submit" value="Войти" name="enter" class="enter-button" />

</form>