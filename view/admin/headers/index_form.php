<?php

$bannerTitle = $response["data"]["bannerTitle"] ?? null;
$bannerSubtitle = $response["data"]["bannerSubtitle"] ?? null;
$headlightTitle = $response["data"]["headlightTitle"] ?? null;
$headlightSubtitle = $response["data"]["headlightSubtitle"] ?? null;
$aboutSubtitle = $response["data"]["aboutSubtitle"] ?? null;
$aboutFooter = $response["data"]["aboutFooter"] ?? null;
$teamSubtitle = $response["data"]["teamSubtitle"] ?? null;
$blogSubtitle = $response["data"]["blogSubtitle"] ?? null;
$partnersSubtitle = $response["data"]["partnersSubtitle"] ?? null;

?>

<div class="container" id="admin-headers-index-form">
    <div class="text-center text-muted">
        <h3 class="text-uppercase ">Modifier les En-tête</h3>
        <p>Le chiffre prêt des étiquettes représente le nombre max de caractères</p>
    </div>

    <div class="col-lg-8 col-md-10 col-12 mx-auto">
        <form class="p-lg-5 p-3 border-light shadow" action="?ctrl=headersAdmin&action=index" method="POST">
            <!-- BANNER -->
            <div class="row mt-3">
                <div class="form-group">
                    <label class="form-label text-muted" for="bannerTitle">Bannière : Titre (100)</label>
                    <textarea class="textareaEditorBoldAndItalic" maxlength="100" class="form-control" name="bannerTitle" id="bannerTitle"><?= $bannerTitle ?></textarea>
                </div>
                <div class="form-group mt-3">
                    <label class="form-label text-muted" for="bannerSubtitle">Bannière : Sous-titre (255)</label>
                    <textarea class="textareaEditorBoldAndItalic" maxlength="255" rows="3" class="form-control" name="bannerSubtitle" id="bannerSubtitle"><?= $bannerSubtitle ?></textarea>
                </div>
            </div>

            <!-- PLAY HEADLIGHT -->
            <div id="tag_playHeaders"></div>
            <div class="row mt-5">
                <div class="form-group">
                    <label class="form-label text-muted" for="headlightTitle">Pièce en évidence : Titre (100)</label>
                    <textarea class="textareaEditorBoldAndItalic" maxlength="100" class="form-control" name="headlightTitle" id="headlightTitle"><?= $headlightTitle ?></textarea>
                </div>
                <div class="form-group mt-3">
                    <label class="form-label text-muted" for="headlightSubtitle">Pièce en évidence : Sous-titre (500)</label>
                    <textarea class="textareaEditorBoldAndItalic" maxlength="500" rows="5" class="form-control" name="headlightSubtitle" id="headlightSubtitle"><?= $headlightSubtitle ?></textarea>
                </div>
            </div>

            <!-- ABOUT -->
            <div id="tag_aboutHeaders"></div>
            <div class="row mt-5">
                <div class="form-group">
                    <label class="form-label text-muted" for="aboutSubtitle">Parcours : Sous-titre (255)</label>
                    <textarea class="textareaEditorBoldAndItalic" maxlength="255" rows="3" class="form-control" name="aboutSubtitle" id="aboutSubtitle"><?= $aboutSubtitle ?></textarea>
                </div>
                <div class="form-group mt-3">
                    <label class="form-label text-muted" for="aboutFooter">Parcours : Pied de page (1500)</label>
                    <textarea class="textareaEditorBoldAndItalic" maxlength="1500" rows="5" class="form-control" name="aboutFooter" id="aboutFooter"><?= $aboutFooter ?></textarea>
                </div>
            </div>

            <!-- TEAM -->
            <div id="tag_teamHeaders"></div>
            <div class="row mt-5">
                <div class="form-group">
                    <label class="form-label text-muted" for="teamSubtitle">Équipe : Sous-titre (255)</label>
                    <textarea class="textareaEditorBoldAndItalic" maxlength="255" rows="3" class="form-control" name="teamSubtitle" id="teamSubtitle"><?= $teamSubtitle ?></textarea>
                </div>
            </div>

            <!-- BLOG -->
            <div id="tag_blogHeaders"></div>
            <div class="row mt-5">
                <div class="form-group">
                    <label class="form-label text-muted" for="blogSubtitle">Articles : Sous-titre (255)</label>
                    <textarea class="textareaEditorBoldAndItalic" maxlength="255" rows="3" class="form-control" name="blogSubtitle" id="blogSubtitle"><?= $blogSubtitle ?></textarea>
                </div>
            </div>

            <!-- PARTNERS -->
            <div id="tag_partnersHeaders"></div>
            <div class="row mt-5">
                <div class="form-group">
                    <label class="form-label text-muted" for="partnersSubtitle">Partenaires : Sous-titre (500)</label>
                    <textarea class="textareaEditorBoldAndItalic" maxlength="500" rows="5" class="form-control" name="partnersSubtitle" id="partnersSubtitle"><?= $partnersSubtitle ?></textarea>
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
