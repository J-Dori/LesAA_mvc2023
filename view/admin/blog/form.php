<?php
    use App\Service\CommonFunctions;

    $editMode = $response["data"]["editMode"] ?? null;

    $active = $response["data"]["active"] ?? null;
    $timeOrder = $response["data"]["timeOrder"] ?? null;
    $date = $response["data"]["date"] ?? null;
    $title = $response["data"]["title"] ?? null;
    $text = $response["data"]["text"] ?? null;
    $imgPath = $response["data"]["imgPath"] ?? null;
?>

<div class="container" id="admin-blog-form">
    <div class="text-center">
        <h3 class="text-uppercase text-muted">Formulaire Article</h3>
        <p class="mb-0"><small class="text-danger "><strong>Champs obligatoires :</strong></small></p>
        <p><small class="text-muted">Tous les champs sont obligatoires</small></p>
    </div>

    <div class="col-lg-10 col-12 mx-auto p-lg-5 p-3 border-light shadow">
        <form action="?ctrl=blogAdmin&action=form<?= $editMode ?>" method="POST" enctype="multipart/form-data">

            <!-- ORDER NUMBER / DATE / TITLE -->
            <div class="row">
                <div class="form-group form-check mb-3 ms-3">
                    <label class="py-0 text-muted form-check-label" for="active">Afficher</label>
                    <input type="checkbox" class="form-check-input" name="active" id="active" <?= $active ? 'checked' : '' ?>>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-2 form-group mb-3">
                    <label class="form-label text-required" for="timeOrder">Ordre #</label>
                    <input type="number" class="form-control" name="timeOrder" maxlength="2" id="timeOrder" value="<?= $timeOrder ?>" required>
                </div>
                <div class="col-12 col-lg-6 form-group mb-3">
                    <label class="form-label text-required" for="date">Date/Période (50)</label>
                    <input type="text" class="form-control" name="date" maxlength="50" id="date" value="<?= $date ?>" placeholder="Janvier 2024 ou Avril - Octobre 2024" required>
                </div>
            </div>

            <div class="form-group mb-5">
                <label class="form-label text-required" for="title">Titre (100)</label>
                <input type="text" class="form-control" name="title" maxlength="50" id="title" value="<?= $title ?>" placeholder="Titre : Sortie au..." required>
            </div>

            <!-- TEXT -->
            <div class="form-group mb-5">
                <label class="form-label text-required" for="text">Texte (1500)</label>
                <textarea class="textareaEditorBoldAndItalic" maxlength="1500" class="form-control" name="text" id="text" required><?= $text ?></textarea>
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
                    <img class="card-img-top w-100 h-auto shadow" style="max-width: 125px" src="<?= CommonFunctions::fileExists(IMG_BLOG, $imgPath) ?>" alt="Photo Article">
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
