<?php

use App\Service\CommonFunctions;

$about = $response["data"]["about"] ?? null;
$headers = $response["data"]["headers"] ?? null;

// only when currentLoop is an even number it will add a class in <li>
$currentLoop = 1;

?>

<!-- About-->
<div class="container" id="admin-about-preview">
    <div class="d-flex flex-wrap justify-content-lg-between justify-content-center align-items-center">
        <h3 class="text-uppercase text-muted text-center mb-3 mb-lg-0">Parcours&ensp;<i class="fa fa-eye text-info"></i></h3>
        <div class="d-flex flex-wrap justify-content-lg-end justify-content-center align-items-center gap-3 w-lg-0 w-100">
            <a class="col-12 col-lg-auto btn btn-info px-3 py-2" href="?ctrl=aboutAdmin&action=index">Liste</a>
            <a class="col-12 col-lg-auto btn btn-primary px-3 py-2" href="?ctrl=aboutAdmin&action=form"><i class="fa-solid fa-square-plus"></i>&ensp;Parcours</a>
        </div>
    </div>

    <hr class="my-3 p-0">

    <div class="text-center">
        <h2 class="section-heading text-uppercase">Notre Parcours</h2>
        <?php if (isset($headers) && !empty($headers)) { ?>
            <div class="mb-5">
                <h3 class="section-subheading text-muted">
                    <?= $headers->getAboutSubtitle() ?>
                </h3>
            </div>
        <?php } ?>
    </div>
    <ul class="timeline">
        <?php foreach ($about as $timeline) { ?>
            <li class="<?= ($currentLoop % 2) ? 'timeline-inverted' : '' ?>">
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="<?= CommonFunctions::fileExists(IMG_ABOUT, $timeline->getImgPath()) ?>" alt="2008" /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4><?= $timeline->getDate() ?></h4>
                        <h4 class="subheading"><?= $timeline->getTitle() ?></h4>
                    </div>
                    <div class="timeline-body">
                        <p class="text-muted">
                            <?= $timeline->getText() ?>
                        </p>
                    </div>
                </div>
            </li>
        <?php
            $currentLoop++;
        } ?>

        <li class="<?= ($currentLoop % 2) ? 'timeline-inverted' : '' ?>">
            <div class="timeline-image">
                <h4>
                    L'histoire
                    <br>
                    ne s'arrête
                    <br>
                    pas ici !
                </h4>
            </div>
        </li>
    </ul>
</div>

<?php if (isset($headers) && !empty($headers)) { ?>
    <div class="text-muted text-center mt-5 px-2">
        <?= $headers->getAboutFooter() ?>
    </div>
<?php } ?>
