<?php
    use App\Service\CommonFunctions;

    if (isset($blockAbout) && !empty($blockAbout)) {

    // only when currentLoop is an even number it will add a class in <li>
    $currentLoop = 1;
?>

    <!-- About-->
    <section class="page-section bg-light" id="about">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Notre Parcours</h2>
            <?php if (isset($headers) && !empty($headers)) { ?>
                <div class="mb-5">
                    <h3 class="section-subheading text-muted"><?= $headers->getAboutSubtitle() ?></h3>
                </div>
            <?php } ?>
        </div>
        <ul class="timeline">
            <?php foreach ($blockAbout as $about) { ?>
                <li class="<?= ($currentLoop % 2) ? 'timeline-inverted' : '' ?>">
                    <div class="timeline-image"><img class="rounded-circle img-fluid" src="<?= CommonFunctions::fileExists(IMG_ABOUT, $about->getImgPath()) ?>" alt="2008" /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4><?= $about->getDate() ?></h4>
                            <h4 class="subheading"><?= $about->getTitle() ?></h4>
                        </div>
                        <div class="timeline-body text-muted">
                            <?= $about->getText() ?>
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
        <div class="text-center mt-5 px-2">
            <?= $headers->getAboutFooter() ?>
        </div>
    <?php } ?>

</section>

<?php } ?>
