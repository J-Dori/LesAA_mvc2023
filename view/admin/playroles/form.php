<?php
    $editMode = $response["data"]["editMode"] ?? null;

    $play = $response["data"]["play"] ?? null;
    $actor = $response["data"]["actor"] ?? null;
    $role = $response["data"]["roleName"] ?? null;

    $playsList = $response["data"]["playsList"] ?? null;
    $actorsList = $response["data"]["actorsList"] ?? null;
?>

<div class="container" id="admin-playRoles-form">
    <div class="text-center">
        <h3 class="text-uppercase text-muted">Formulaire Rôles</h3>
        <p class="mb-0"><small class="text-danger "><strong>Champs obligatoires :</strong></small></p>
        <p><small class="text-muted">Pièce, Comédien</small></p>
    </div>

    <div class="col-lg-8 col-md-10 col-12 mx-auto p-lg-5 p-3 border-light shadow">
        <form action="?ctrl=playRolesAdmin&action=form<?= $editMode ?>" method="POST">
            <!-- PLAY -->
            <div class="row">
                <label class="form-label form-label text-required" for="play">Pièce</label>
                <select class="form-select" id="play" name="play" required>
                    <option <?= empty($editMode) ?? 'selected' ?>>Liste des Pièces...</option>
                    <?php foreach ($playsList as $list) { ?>
                        <option value="<?= $list->getId() ?>"
                            <?php if ($editMode && $play == $list) { echo ' selected'; } ?>
                        ><?= $list->getYearTitle() ?></option>
                    <?php } ?>
                </select>
            </div>

            <!-- ROLE -->
            <div class="row mt-3">
                <div class="form-group">
                    <label class="form-label text-muted" for="roleName" >Rôle</label>
                    <input type="text" class="form-control" name="roleName" id="roleName" value="<?= $role ?>" placeholder="Nom du rôle">
                </div>
            </div>

            <!-- ACTOR -->
            <div class="row mt-3">
                <label class="form-label text-required" for="actor">Comédien</label>
                <select class="form-select" id="actor" name="actor" required>
                    <option selected>Liste des Comédiens...</option>
                    <?php foreach ($actorsList as $list) { ?>
                        <option value="<?= $list->getId() ?>"
                            <?php if ($editMode && $actor == $list) { echo ' selected'; } ?>
                        ><?= $list->getFullName() ?></option>
                    <?php } ?>
                </select>
            </div>

            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

            <hr class="my-3">

            <div class="row">
                <div class="d-flex flex-wrap justify-content-evenly gap-2">
                    <button type="reset" class="btn btn-danger col-md-4 px-3 py-2">Réinitialiser</button>
                    <button type="submit" class="btn btn-primary col-md-4 px-3 py-2">Sauvegarder</button>
                </div>
            </div>
        </form>
    </div>
</div>
