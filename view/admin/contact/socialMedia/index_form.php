<?php

$facebook = $response["data"]["facebook"] ?? null;
$youtube = $response["data"]["youtube"] ?? null;
$instagram = $response["data"]["instagram"] ?? null;
$tiktok = $response["data"]["tiktok"] ?? null;
$snapchat = $response["data"]["snapchat"] ?? null;
$twitter = $response["data"]["twitter"] ?? null;

?>

<div class="container" id="admin-socialMedia-index-form">
    <div class="text-center text-muted">
        <h3 class="text-uppercase ">Réseaux Sociaux</h3>
        <p>Nombre max de caractères : 255</p>
    </div>

    <div class="col-lg-8 col-md-10 col-12 mx-auto">
        <form class="p-lg-5 p-3 border-light shadow" action="?ctrl=socialMediaAdmin&action=index" method="POST">

            <div class="input-group mb-3">
                <span class="input-group-text" id="facebook_label"><i style="color: #1161ea; width: 25px;" class="fab fa-facebook"></i></span>
                <input type="text" class="form-control" aria-label="Facebook" aria-describedby="facebook_label"
                       placeholder="Facebook" name="facebook" id="facebook"
                       value="<?= $facebook ?>" >
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="youtube_label"><i style="color: #e01e1e; width: 25px;" class="fab fa-youtube"></i></span>
                <input type="text" class="form-control" aria-label="Youtube" aria-describedby="youtube_label"
                       placeholder="Youtube" name="youtube" id="youtube"
                       value="<?= $youtube ?>" >
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="instagram_label"><i style="color: #d43fe7; width: 25px;" class="fab fa-instagram"></i></span>
                <input type="text" class="form-control" aria-label="Instagram" aria-describedby="instagram_label"
                       placeholder="Instagram" name="instagram" id="instagram"
                       value="<?= $instagram ?>" >
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="tiktok_label"><i style="color: #181818; width: 25px;" class="fab fa-tiktok"></i></span>
                <input type="text" class="form-control" aria-label="Tiktok" aria-describedby="tiktok_label"
                       placeholder="Tiktok" name="tiktok" id="tiktok"
                       value="<?= $tiktok ?>" >
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="snapchat_label"><i style="color: #e7c802; width: 25px;" class="fab fa-snapchat fa-lg"></i></span>
                <input type="text" class="form-control" aria-label="Snapchat" aria-describedby="snapchat_label"
                       placeholder="Snapchat" name="snapchat" id="snapchat"
                       value="<?= $snapchat ?>" >
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="twitter_label"><i style="color: #2ac9f5; width: 25px;" class="fab fa-twitter fa-lg"></i></span>
                <input type="text" class="form-control" aria-label="Twitter" aria-describedby="twitter_label"
                       placeholder="Twitter" name="twitter" id="twitter"
                       value="<?= $twitter ?>" >
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
