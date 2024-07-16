<?php
    $medias = $response['data']['socialmedia'] ?? null;
?>

<footer class="footer bg-dark text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-lg-start">
                <p class="mb-1">Copyright <a class="text-white " href="?ctrl=security&action=login">&copy;</a> Les Agit'acteurs <?= date("Y") ?></p>
            </div>
            <div class="col-lg-4 my-3 my-lg-0">
                <?php if (!empty($medias)) {
                    if ($medias->getFacebook()) { ?>
                    <a class="btn btn-light btn-social mx-2" href="<?= $medias->getFacebook() ?>" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <?php } if ($medias->getYoutube()) { ?>
                    <a class="btn btn-light btn-social mx-2" href="<?= $medias->getYoutube() ?>" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                <?php } if ($medias->getInstagram()) { ?>
                    <a class="btn btn-light btn-social mx-2" href="<?= $medias->getInstagram() ?>" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                <?php } if ($medias->getTiktok()) { ?>
                    <a class="btn btn-light btn-social mx-2" href="<?= $medias->getTiktok() ?>" target="_blank" title="TitTok"><i class="fab fa-tiktok"></i></a>
                <?php } if ($medias->getSnapchat()) { ?>
                    <a class="btn btn-light btn-social mx-2" href="<?= $medias->getSnapchat() ?>" target="_blank" title="Snapchat"><i class="fab fa-snapchat"></i></a>
                <?php } if ($medias->getTwitter()) { ?>
                    <a class="btn btn-light btn-social mx-2" href="<?= $medias->getTwitter() ?>" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
                <?php } } ?>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a class="link-light  me-3" href="?ctrl=home&action=privacy" target="_blank">Politique de Confidentialité</a>
            </div>
        </div>
    </div>
</footer>
