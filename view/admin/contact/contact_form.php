<?php

$editMode = $response["data"]["editMode"] ?? null;

$responsableName = $response["data"]["responsableName"] ?? null;
$postAddress = $response["data"]["postAddress"] ?? null;
$postPhone = $response["data"]["postPhone"] ?? null;
$email = $response["data"]["email"] ?? null;
$theaterName = $response["data"]["theaterName"] ?? null;
$theaterAddress = $response["data"]["theaterAddress"] ?? null;
$theaterMapLink = $response["data"]["theaterMapLink"] ?? null;
$onlineBooking = $response["data"]["onlineBooking"] ?? null;

?>

<div class="container" id="admin-contact-form">
    <div class="text-center text-muted">
        <h3 class="text-uppercase ">Formulaire Contact</h3>
        <p>Le chiffre prêt des étiquettes représente le nombre max de caractères</p>
    </div>

    <div class="col-lg-8 col-md-10 col-12 mx-auto">
        <form class="p-lg-5 p-3 border-light shadow" action="?ctrl=contactAdmin&action=formContact<?= $editMode ?>" method="POST">
            <!-- RESPONSABLE / ADDRESS / PHONE # -->
            <div class="row mt-3">
                <h5 class="text-muted">Contacts</h5>
                <div class="form-group">
                    <label class="form-label text-required" for="responsableName">Nom (100)</label>
                    <input maxlength="100" class="form-control required" name="responsableName" id="responsableName" value="<?= $responsableName ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label text-muted" for="postAddress">Adresse (255)</label>
                    <textarea class="textareaEditorBoldAndItalic" maxlength="255" class="form-control" name="postAddress" id="postAddress"><?= $postAddress ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label text-muted" for="postPhone">Nº Téléphone</label>
                    <input type="tel" class="form-control" name="postPhone" id="postPhone" pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" value="<?= $postPhone ?>" placeholder="ex: 06 00 00 00 00">
                    <small id="postPhonePattern" class="text-muted">Respectez le format : 06 00 00 00 00</small>
                </div>
                <div class="form-group">
                    <label class="form-label text-muted" for="email">Email (255)</label>
                    <input type="email" class="form-control" name="email" id="email" maxlength="255" value="<?= $email ?>" placeholder="E-mail">
                </div>
            </div>

            <!-- THEATER NAME / ADDRESS / MAP URL / BOOKING URL -->

            <div class="row mt-5">
                <h5 class="text-muted">Théâtre</h5>
                <div class="form-group">
                    <label class="form-label text-muted" for="theaterName">Nom Salle (255)</label>
                    <input maxlength="100" class="form-control" name="theaterName" id="bannerTitle" value="<?= $theaterName ?>">
                </div>
                <div class="form-group">
                    <label class="form-label text-muted" for="theaterAddress">Adresse (255)</label>
                    <textarea class="textareaEditorBoldAndItalic" maxlength="255" class="form-control" name="theaterAddress" id="theaterAddress"><?= $theaterAddress ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label text-muted" for="theaterMapLink">URL Google Maps</label>
                    <input class="form-control" type="url" name="theaterMapLink" id="theaterMapLink" maxlength="500" value="<?= $theaterMapLink ?>"
                           placeholder="Insérer uniquement l'URL">
                    <small class="text-muted">Sur Google Maps, cliquez sur "Partager" et "Intégrer une carte"</small>
                    <br>
                    <small class="text-muted">Collez ici uniquement le texte entre "src=" et "width=" sans les guillemets</small>
                </div>
                <div class="form-group">
                    <label class="form-label text-muted" for="onlineBooking">URL Réservations en ligne</label>
                    <input class="form-control" type="url" name="onlineBooking" id="onlineBooking"
                           maxlength="500"
                           value="<?= $onlineBooking ?>"
                           placeholder="Sur Google Maps, faite Partager et Copier le URL">
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
