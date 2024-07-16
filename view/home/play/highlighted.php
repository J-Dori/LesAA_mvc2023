<?php
use App\Service\CommonFunctions;

if (isset($blockHighlight) && !empty($blockHighlight)) {
    $onlineBooking = $blockContact->getOnlineBooking() ?? null; //online booking url in active Contact
?>
<!-- Front Play -->
<section class="page-section" id="front-play">
    <div class="container">
        <div class="row text-center">
            <?php if (isset($headers) && !empty($headers)) { ?>
                <div class="mb-5">
                    <h2 class="section-heading text-uppercase"><?= $headers->getHeadlightTitle() ?></h2>
                    <h3 class="section-subheading text-muted"><?= $headers->getHeadlightSubtitle() ?></h3>
                </div>
            <?php } ?>
            <div class="col-md-4">
                <div class="text-center mb-5">
                    <h3 class="section-heading text-uppercase text-primary"><?= $blockHighlight->getPlayStatusTitle() ?></h3>
                </div>
                <img class="shadow w-100 h-auto" style="max-width: 500px;" src="<?= CommonFunctions::fileExists(IMG_PLAY_FLYERS, $blockHighlight->getImgPath()) ?>" alt="Pièce" />
                <a class="btn btn-light rounded-2 w-100 px-5 py-3 mt-3 shadow" href="?ctrl=home&action=playIndex">Nos Pièces</a>
            </div>
            <div class="col-md-8">
                <h3 class="mt-4 mt-md-0 text-uppercase"><?= $blockHighlight->getTitle() ?></h3>
                <p class="mt-md-5 mt-3 text-muted lead play-font-description">
                    <?= $blockHighlight->getDescription() ?>
                </p>
                <div class="mt-5">
                    <h6 class="text-uppercase text-muted">
                        <span class="db-ta"><?= $blockHighlight->getActiveText() ?></span>
                    </h6>
                </div>
                <?php if ($blockHighlight->getPlayStatusTitle() == 'En Scène' || $blockHighlight->getDateStartMinus30Days()) { ?>
                    <div class="col-12 text-center mx-auto">
                        <h4 class="mt-5">Réservez votre place</h4>
                        <?php if (!empty($onlineBooking)) { ?>
                            <a class="btn btn-danger rounded mt-3 me-md-5 px-5 py-3 shadow" href="<?= $onlineBooking ?>" target="_blank">En ligne</a>
                        <?php } ?>
                        <a class="btn btn-secondary rounded mt-3 px-5 py-3 shadow" href="/#contact">E-mail / Téléphone</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php } ?>