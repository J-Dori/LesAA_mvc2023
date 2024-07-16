<?php
use App\Service\CommonFunctions;

if (!isset($blockHighlight) && empty($blockHighlight)) {
$onlineBooking = $blockContact->getOnlineBooking() ?? null; //online booking url in active Contact
?>

<!-- Front Play -->
<div class="container" id="blockHighlight">
    <h5 class="text-muted text-center mx-auto">Aucune pièce est mise en évidence</h5>
</div>

<?php } else { ?>

<div class="container" id="blockHighlight">
    <div class="card mb-3" style="max-width: 650px;">
        <div class="row no-gutters">
            <div class="col-md-4 text-center">
                <img class="card-img" style="max-width: 200px;" src="<?= CommonFunctions::fileExists(IMG_PLAY_FLYERS, $blockHighlight->getImgPath()) ?>" alt="Pièce">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $blockHighlight->getYear() .'<br>'. $blockHighlight->getTitle() ?></h5>
                    <p class="card-text"><strong>Statut : </strong><?= $blockHighlight->getPlayStatusTitle() ?></p>
                    <p class="card-text"><strong>Dates : </strong>
                        <?= date_format($blockHighlight->getDateStart(), 'd-m') ?>&ensp;au&ensp;<?= date_format($blockHighlight->getDateEnd(), 'd-m') ?>
                    </p>
                    <?php if ($blockHighlight->getPlayStatusTitle() == 'En Scène' || $blockHighlight->getDateStartMinus30Days()) { ?>
                        <p class="card-text">
                            <small class="text-muted">Réservations ouvertes</small>
                        </p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <a class="text-muted  text-center" href="/">
            <div class="card-footer">
                Modifier
            </div>
        </a>
    </div>
</div>
<?php } ?>
