<?php

use App\Service\CommonFunctions;

$plays = $response["data"]["plays"]; //all plays by Year DESC

if (isset($plays) && !empty($plays)) { ?>
<section id="index-play-cards container" class="py-5 px-3">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 justify-content-center">
        <?php foreach ($plays as $play) { ?>
            <div class="col card-cols">
                <a class="card text-center text-muted " href="?ctrl=home&action=play&id=<?= $play->getId() ?>">
                    <div>
                        <img class="card-img-top w-100 h-auto shadow" src="<?= CommonFunctions::fileExists(IMG_PLAY_FLYERS, $play->getImgPath()) ?>" alt="Pièce">
                        <div class="card-body">
                            <h5 class="card-title"><?= $play->getYear() ?></h5>
                            <p class="card-text"><?= $play->getTitle() ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</section>
<?php } ?>
