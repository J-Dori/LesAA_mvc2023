<?php
    //$firstname = $response["data"]["firstname"] ?? null;
    //$lastname = $response["data"]["lastname"] ?? null;
    //$email = $response["data"]["email"] ?? null;
    //$phone = $response["data"]["phone"] ?? null;
?>

<div class="container" id="admin-user-form-new">
    <div class="text-center">
        <h3 class="text-uppercase text-muted">Formulaire Utilisateurs</h3>
        <p class="mb-0"><small class="text-danger "><strong>Champs obligatoires :</strong></small></p>
        <p><small class="text-muted">Prénom, Nom, E-mail, Mot de Passe et Rôle</small></p>
    </div>
    <div class="row gap-2">

        <div class="col-lg-5 col-12 mx-auto p-lg-5 p-3 border-light shadow">
            <form action="?ctrl=userAdmin&action=register" method="POST">
                <!-- FIRSTNAME / LASTNAME -->
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label text-required" for="firstname">Prénom</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" maxlength="50" placeholder="Prénom" required>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label text-required" for="lastname">NOM</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" maxlength="50" placeholder="NOM" required>
                    </div>
                </div>

                <!-- PHONE -->
                <div class="row">
                    <div class="form-group">
                        <label class="form-label text-muted" for="phone">Nº Téléphone</label>
                        <input type="tel" class="form-control" name="phone" id="phone" pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" placeholder="ex: 06 00 00 00 00">
                        <small id="phonePattern" class="text-muted">Respectez le format : 06 00 00 00 00</small>
                    </div>
                </div>

                <!-- EMAIL -->
                <div class="row">
                    <div class="form-group mb-3">
                        <label class="form-label text-required" for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" maxlength="255" placeholder="E-mail">
                    </div>
                </div>

                <!-- PASSWORD -->
                <div class="row">
                    <div class="col-12 col-md-6 form-group mb-3">
                        <label class="form-label text-required" for="password">Mot de Passe</label>
                        <input type="text" class="form-control" name="password" id="password" minlength="8" maxlength="25" placeholder="Mot de Passe">
                    </div>
                    <div class="col-12 col-md-6 form-group mb-3">
                        <label class="form-label text-required" for="password_repeat">Répétez le Mot de Passe</label>
                        <input type="text" class="form-control" name="password_repeat" id="password_repeat" minlength="8" maxlength="25" placeholder="Répétez le Mot de Passe">
                    </div>
                    <small id="passwordPattern" class="text-muted">
                        Le mot de passe doit contenir entre <code>8 et 25 caractères</code>, dont :
                        <br>
                        - une majuscule, une minuscule, un chiffre <br>
                        - un caractère special <code>!@#$%^&*()-+</code> <br>
                    </small>
                </div>

                <!-- USER ROLE -->
                <div class="row mt-3">
                    <div class="form-group col-12 ps-4">
                        <p class="form-check-label fw-bold text-danger mb-2">Rôle d'utilisateur</p>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="1" id="roleAdmin">
                            <label class="form-check-label" for="roleAdmin">
                                Administrateur
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="2" id="roleAccount">
                            <label class="form-check-label" for="roleAccount">
                                Trésorier
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="3" id="roleUser" checked>
                            <label class="form-check-label" for="roleUser">
                                Aucun
                            </label>
                        </div>
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
