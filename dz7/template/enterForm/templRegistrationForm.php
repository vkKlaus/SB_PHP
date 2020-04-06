<form method="POST" class="enter-form">

    <div class="form-registration">
        <div class="form-registration-block">
            <label class="enter-label" for="user-id">Вашe имя*:</label>

            <input type="text" name="user" value="<?= $user ?>" id="user-id" class="enter-field">

            <label class="enter-label" for="phone-id">Телефон (только цифры):</label>

            <input type="text" name="phone" value="<?= $phone ?>" id="phone-id" class="enter-field" />

            <label class="enter-label" for="notification-id">Согласен получать оповещения на e-mail:</label>

            <input type="checkbox" name="emailNotification" <?= $emailNotification ? 'checked' : '' ?> id="notification-id" class="enter-field check" />
        </div>

        <div class="form-registration-block">
            <label class="enter-label" for="login-id">Ваш e-mail*:</label>

            <input type="text" name="login" value="<?= $login ?>" id="login-id" class="enter-field">

            <label class="enter-label" for="password-id-1">Введите пароль*:</label>

            <input type="password" name="password_1" value="<?= $password_1 ?>" id="password-id-1" class="enter-field" />

            <label class="enter-label" for="password-id-2">повторите пароль*:</label>

            <input type="password" name="password_2" value="<?= $password_2 ?>" id="password-id-2" class="enter-field" />
        </div>
    </div>

    <input type="submit" value="Зарегистрироваться" name="enter" class="enter-button" />


</form>