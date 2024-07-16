<div id="user_login" class="my-5 col-lg-3 col-md-6 col-sm-9 col-xm-12 text-center m-auto">
    <h1 class="my-4">Connexion</h1>
    <form id="formUser_login" action="?ctrl=security&action=login" method="post">
        <p>
            <input class="form-control" type="email" name="email" id="email" placeholder="E-mail..." required>
        </p>
        <p>
            <input class="form-control" type="password" name="password" id="password" placeholder="Mot de passe..." required>
        </p>
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <p><input class="btn btn-warning px-5" type="submit" value="Connexion"></p>
    </form>
</div>
