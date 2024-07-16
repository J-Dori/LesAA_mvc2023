<?php
    use App\Service\Session;
?>

<div class="container" id="admin-user-form-update-password">
    <div class="text-center mb-3">
        <h3 class="text-uppercase text-muted">Modifier Mot de Passe</h3>
        <p><small class="text-danger mb-3">Après avoir modifié votre mot de passe, vous devrez vous reconnecter</small></p>
        <p><small class="text-muted"><?= Session::getUser()->getEmail() ?></small></p>
    </div>
    <div class="row gap-2">
        <div class="col-lg-5 col-12 mx-auto p-lg-5 p-3 border-light shadow">
            <form action="?ctrl=userAdmin&action=updatePassword&id=<?= Session::getUser()->getId() ?>" method="POST">

                <!-- CURRENT PASSWORD -->
                <div class="row">
                    <div class="col-12 form-group">
                        <label class="form-label text-required" for="current_password">Mot de Passe Actuel</label>
                        <input type="text" class="form-control" name="current_password" id="current_password" minlength="8" maxlength="25" placeholder="Mot de Passe Actuel">
                    </div>
                </div>

                <!-- NEW PASSWORD -->
                <div class="row">
                    <div class="col form-group">
                        <label class="form-label text-required" for="password">Nouveau Mot de Passe</label>
                        <input type="text" class="form-control" name="password" id="password" minlength="8" maxlength="25" placeholder="Nouveau Mot de Passe">
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group">
                        <label class="form-label text-required" for="password_repeat">Répétez le Mot de Passe</label>
                        <input type="text" class="form-control" name="password_repeat" id="password_repeat" minlength="8" maxlength="25" placeholder="Répétez le Mot de Passe">
                        <small id="passwordPattern" class="text-muted">
                            Le mot de passe doit contenir entre <code>8 et 25 caractères</code>, dont :
                            <br>
                            - une majuscule, une minuscule, un chiffre <br>
                            - un caractère special <code>!@#$%^&*()-+</code> <br>
                        </small>
                    </div>
                </div>

                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                <hr class="my-3">

                <div class="row">
                    <div class="d-flex flex-wrap justify-content-evenly gap-2">
                        <button type="reset" class="btn btn-danger col-md-4 px-3 py-2">Réinitialiser</button>
                        <button type="submit" id="submitUser" class="btn btn-primary col-md-4 px-3 py-2">Sauvegarder</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= JS_PATH . 'user_password.js' ?>"></script>
