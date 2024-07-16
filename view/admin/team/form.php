<?php
    use App\Service\CommonFunctions;

    $editMode = $response["data"]["editMode"] ?? null;

    $roleOrder = $response["data"]["roleOrder"] ?? null;
    $name = $response["data"]["name"] ?? null;
    $role = $response["data"]["role"] ?? null;
    $description = $response["data"]["description"] ?? null;
    $imgPath = $response["data"]["imgPath"] ?? null;
?>

<div class="container" id="admin-team-form">
    <div class="text-center">
        <h3 class="text-uppercase text-muted">Formulaire Membres</h3>
        <p class="mb-0"><small class="text-danger "><strong>Champs obligatoires :</strong></small></p>
        <p><small class="text-muted">Ordre #, Nom et Rôle</small></p>
    </div>

    <div class="col-lg-10 col-12 mx-auto p-lg-5 p-3 border-light shadow">
        <form action="?ctrl=teamAdmin&action=form<?= $editMode ?>" method="POST" enctype="multipart/form-data">

            <!-- ORDER NUMBER / NAME / ROLE -->
            <div class="row">
                <div class="col-4 col-lg-2 form-group mb-3">
                    <label class="form-label text-required" for="roleOrder">Ordre #</label>
                    <input type="number" class="form-control" name="roleOrder" maxlength="2" id="roleOrder" value="<?= $roleOrder ?>" required>
                </div>
                <div class="col-8 col-lg-4 form-group mb-3">
                    <label class="form-label text-required" for="name">Nom (50)</label>
                    <input type="text" class="form-control" name="name" maxlength="50" id="name" value="<?= $name ?>" placeholder="Nom du Membre" required>
                </div>
                <div class="col-12 col-lg-6 form-group mb-3">
                    <label class="form-label text-required" for="role">Rôle (50)</label>
                    <input type="text" class="form-control" name="role" maxlength="50" id="role" value="<?= $role ?>" placeholder="Rôles du Membre" required>
                </div>
            </div>

            <!-- DESCRIPTION -->
            <div class="form-group mb-5">
                <label class="form-label text-muted" for="description">Description du Rôle (255)</label>
                <textarea class="textareaEditorBoldAndItalic" maxlength="255" class="form-control" name="description" id="description"><?= $description ?></textarea>
            </div>

            <!-- IMAGE -->
            <?php if (!empty($editMode)) { ?>
                <div class="text-center bg-light shadow w-100 p-1 mb-4">
                    <p class="mt-3 mb-0"><small class="text-danger text-uppercase"><strong>Attention</strong></small></p>
                    <p><small class="text-muted">Si vous modifiez l'image actuelle, celle-ci sera supprimée et remplacée par le nouveau ficher téléchargé</small></p>
                </div>
            <?php } ?>
            <div class="form-group d-inline-flex justify-content-start align-items-center flex-wrap flex-lg-nowrap">
                <div class="col-lg-2 col-md-4 col-12 me-md-3 mb-3 mb-md-0 text-center mx-auto">
                    <img class="card-img-top w-100 h-auto shadow" style="max-width: 125px" src="<?= CommonFunctions::fileExists(IMG_TEAM, $imgPath) ?>" alt="Photo Membre">
                </div>
                <div class="col-lg-10 col-md-8 col-12">
                    <label class="form-label text-muted custom-file-label" for="fileToUpload" data-browse="Charger">Sélectionner un fichier</label>
                    <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload" lang="fr">
                    <?php if (!empty($imgPath)) {
                        //@TODO Delete Image
                    ?>
                        <p style="padding-left: 3px"><small class="text-muted"><strong>Fichier actuel : </strong><?= $imgPath ?></small></p>
                        <p style="padding-left: 3px"><small><a class="text-danger " href="#">Supprimer</a></small></p>
                    <?php } ?>
                    <p>
                        <small class="mt-3 text-muted" style="padding-left: 3px">
                            <strong>Taille max : </strong>2 Mo<br>
                            Utiliser un compresseur d'images en ligne : <a href='https://www.resizepixel.com/fr/' target='blanc'>cliquez ici</a>
                        </small>
                    </p>
                </div>
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
