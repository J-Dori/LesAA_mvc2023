<?php
    $title = $response["data"]["title"];
?>
<?php include('view/gestion/gestionNavBar.php') ?>
<div class="ges_container" id="user_register">
    <h1 id="title" class="text-center">Nouvel utilisateur</h1>
    <form id="formUser_register" class="text-center" action="?ctrl=security&action=register" method="post">
        <input class="form-control" type="text" name="fname" id="fname" placeholder="Prénom" required>
        <input class="form-control" type="text" name="lname" id="lname" placeholder="NOM" required>
        <input class="form-control" type="email" name="email" id="email" autocapitalize="none" placeholder="E-mail..." required>
        <div class="input_icons formUser_pass_verify">
            <i class="fa fa-eye togglePassword" id="togglePassword"></i>
            <input class="form-control register_nopass" type="password" name="password" id="password" placeholder="Mot de passe..." required>
        </div>
        <div class="input_icons formUser_pass_verify">
            <i class="fa fa-eye togglePassword" id="togglePasswordRepeat"></i>
            <input class="form-control register_nopass" type="password" name="password_repeat" id="password_repeat" placeholder="Répétez le mot de passe..." required>
        </div>
        <p id="passwordHelpText" class="text-muted">
            <span id="pass_min">Minimum 8 caractères&nbsp;</span>
            <span id="pass_max">(máx 25)</span><br>
            <span id="pass_upper"><i class="fa fa-circle-xmark text-danger"></i>&ensp;1 Majuscule, </span><br>
            <span id="pass_lower"><i class="fa fa-circle-xmark text-danger"></i>&ensp;1 miniscule, </span><br>
            <span id="pass_digit"><i class="fa fa-circle-xmark text-danger"></i>&ensp;1 chiffre, </span><br>
            <span id="pass_symbol"><i class="fa fa-circle-xmark text-danger"></i>&ensp;1 symbole « !?#$%& *-+ . _ »</span>
</p>
        <span class="ges_labels">Rôle d'utilisateur</span>
        <select class="form-select mt-1" name="role" id="role">
            <option value="0">Utilisateur</option>
            <option value="1">Administrateur</option>
        </select>
        <span id="user_roleWarning" class="my-3" ><b>Attention</b><br>Si vous sélectionnez "Administrateur", le nouvel utilisateur pourra <b>gérer l'intégralité des données</b> de l'application.</span>

        <input id="btn_submit" class="btn btn-outline-info text-black mt-3" type="submit" value="Sauvegarder" disabled>
        <a href="?ctrl=gestion&action=user_index" class="btn btn-outline-secondary btn-cancelForm">Annuler</a>
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    </form>
</div>

<script src="<?= JS_USER ?>"></script>
