<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Вход...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs"">
                    <li class=" nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#authorization">Авторизация</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#registration">Регистрация</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#recoverPas">Забыли пароль?</a>
                    </li>
                </ul>

                <div class="tab-content bg-light">
                    <div class="tab-pane fade show active" id="authorization">
                        <?php include_once 'autorization.php' ?>
                    </div>

                    <div class="tab-pane fade" id="registration">
                        <?php include_once 'registration.php' ?>
                    </div>

                    <div class="tab-pane fade" id="recoverPas">
                        <?php include_once 'recoverPas.php' ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>