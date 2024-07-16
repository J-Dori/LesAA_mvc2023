<?php
    use App\Service\CommonFunctions;

    $editMode = $response["data"]["editMode"] ?? null;

    $year = $response["data"]["year"] ?? null;
    $title = $response["data"]["title"] ?? null;
    $description = $response["data"]["description"] ?? null;
    $dateStart = $response["data"]["dateStart"] ?? null;
    $dateEnd = $response["data"]["dateEnd"] ?? null;
    $active = $response["data"]["active"] ?? null;
    $activeText = $response["data"]["activeText"] ?? null;
    $videoPath = $response["data"]["videoPath"] ?? null;
    $imgPath = $response["data"]["imgPath"] ?? null;
?>

<div class="container" id="admin-play-form">
    <div class="text-center">
        <h3 class="text-uppercase text-muted">Formulaire Pièces</h3>
        <p class="mb-0"><small class="text-danger "><strong>Champs obligatoires :</strong></small></p>
        <p><small class="text-muted">Année, Titre, Description, Date Début et Fin</small></p>
    </div>

    <div class="col-lg-10 col-12 mx-auto p-lg-5 p-3 border-light shadow">
        <form action="?ctrl=playAdmin&action=form<?= $editMode ?>" method="POST" enctype="multipart/form-data">
            <!-- YEAR / TITLE -->
            <div class="row">
                <div class="col-lg-4 form-group mb-3">
                    <label class="form-label text-required" for="year">Année</label>
                    <input type="number" class="form-control" name="year" maxlength="4"  id="year" value="<?= $year ?>" placeholder="ex: 2023" required>
                </div>
                <div class="col-lg-8 form-group mb-3">
                    <label class="form-label text-required" for="title">Titre</label>
                    <input type="text" class="form-control" name="title" id="title" maxlength="255"  value="<?= $title ?>" placeholder="Titre de la pièce" required>
                </div>
            </div>

            <!-- DESCRIPTION -->
            <div class="row">
                <div class="form-group mb-3">
                    <label class="form-label text-required" for="description">Description</label>
                    <small class="ps-3 text-muted form-char-length">5000 caractères</small>
                    <textarea class="textareaEditor" name="description" id="description"><?= $description ?></textarea>
                </div>

            </div>

            <!-- DATES -->
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class='input-group d-flex align-items-center'>
                            <label class="form-label text-required" for="dateStart">Date Début&ensp;</label>
                            <input type='date' class="form-control" name="dateStart" id="dateStart" value="<?= $dateStart ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-3 mt-lg-0">
                    <div class="form-group">
                        <div class='input-group d-flex align-items-center'>
                            <label class="form-label text-required" for="dateEnd">Date Fin&ensp;</label>
                            <input type='date' class="form-control" name="dateEnd" id="dateEnd" value="<?= $dateEnd ?>" required/>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ACTIVE PLAY -->
            <div class="row mt-5">
                <div class="form-group form-check mb-3 ms-3">
                    <label class="py-0 text-muted form-check-label" for="active">Mettre en évidence</label>
                    <input type="checkbox" class="form-check-input" name="active" id="active" <?= $active ? 'checked' : '' ?>>
                </div>
            </div>
            <div class="row">
                <div class="form-group mb-3">
                    <label class="form-label text-muted" for="activeText">Texte en évidence</label>
                    <small class="ps-3 text-muted form-char-length">500 caractères</small>
                    <textarea class="textareaEditor" name="activeText" id="activeText"><?= $activeText ?></textarea>
                </div>
            </div>

            <!-- VIDEO / YOUTUBE URL -->
            <div class="row my-5">
                <div class="form-group mb-3">
                    <label class="form-label text-muted" for="videoPath">URL Vidéo</label>
                    <input class="form-control" type="url" name="videoPath" id="videoPath" maxlength="500" value="<?= $videoPath ?>" placeholder="Ex : https://youtu.be/RgOc1234vSA?feature=shared">
                    <small class="text-muted my-1">Ouvrez la vidéo sur YouTube et cliquez sur "Partager", puis cliquez sur "Copier".</small>
                </div>
            </div>

            <!-- IMAGE / FLYER -->
            <?php if (!empty($editMode)) { ?>
                <div class="text-center bg-light shadow w-100 p-1 mb-4">
                    <p class="mt-3 mb-0"><small class="text-danger text-uppercase"><strong>Attention</strong></small></p>
                    <p><small class="text-muted">Si vous modifiez l'image actuelle, celle-ci sera supprimée et remplacée par le nouveau ficher téléchargé</small></p>
                </div>
            <?php } ?>
            <div class="form-group d-inline-flex justify-content-start align-items-center flex-wrap flex-lg-nowrap">
                <div class="col-lg-2 col-md-4 col-12 me-md-3 mb-3 mb-md-0 text-center mx-auto">
                    <img class="card-img-top w-100 h-auto shadow" style="max-width: 125px" src="<?= CommonFunctions::fileExists(IMG_PLAY_FLYERS, $imgPath) ?>" alt="Pièce">
                </div>
                <div class="col-lg-10 col-md-8 col-12">
                    <label class="form-label text-muted custom-file-label" for="fileToUpload" data-browse="Charger">Sélectionner un fichier</label>
                    <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload" lang="fr">
                    <?php if (!empty($imgPath)) { ?>
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
