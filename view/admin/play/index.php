<?php

use App\Service\CommonFunctions;

$plays = $response["data"]["plays"]; //all plays by Year DESC

?>

<div class="container" id="amin-play-index">
    <div class="d-flex flex-wrap justify-content-lg-between justify-content-center align-items-center">
        <h3 class="text-uppercase text-muted text-center w-lg-0 w-100">Pièces</h3>
        <div class="d-flex flex-wrap justify-content-lg-end justify-content-center align-items-center gap-3 w-lg-0 w-100">
            <a class="col-12 col-lg-auto btn btn-dark px-3 py-2" href="?ctrl=actorAdmin&action=index">Comédiens</a>
            <a class="col-12 col-lg-auto btn btn-dark px-3 py-2" href="?ctrl=playRolesAdmin&action=index">Rôles</a>
            <a class="col-12 col-lg-auto btn btn-primary px-3 py-2" href="?ctrl=playAdmin&action=form"><i class="fa-solid fa-square-plus"></i>&ensp;Pièce</a>
        </div>
    </div>

    <hr class="my-5">

    <?php if (isset($plays) && !empty($plays)) { ?>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-4 justify-content-center">
            <?php foreach ($plays as $play) { ?>
            <div class="col card-cols">
                <div class="card">
                    <div class="card-header d-flex justify-content-between px-3 py-2">
                        <a href="?ctrl=playAdmin&action=form&id=<?= $play->getId() ?>"><i class="fa-solid fa-pen-to-square text-black"></i></a>
                        <a href="?ctrl=playAdmin&action=view&id=<?= $play->getId() ?>"><i class="fa-solid fa-eye text-secondary"></i></a>
                        <a href="?ctrl=playAdmin&action=delete&id=<?= $play->getId() ?>"><i class="fa-solid fa-trash-can text-danger"></i></a>
                    </div>
                    <img class="card-img-top w-100 h-auto shadow" src="<?= CommonFunctions::fileExists(IMG_PLAY_FLYERS, $play->getImgPath()) ?>" alt="Pièce">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <?php
                                if ($play->getActive()) {
                                    echo '<i class="fa-solid fa-star text-primary"></i>&ensp;';
                                    echo $play->getYear();
                                    echo '&ensp;<i class="fa-solid fa-star text-primary"></i>';
                                } else {
                                    echo $play->getYear();
                                }
                            ?>
                        </h5>
                        <small class="card-text"><?= $play->getTitle() ?></small>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="row text-muted text-center mx-auto">
            <h5>Aucune pièce enregistrée</h5>
        </div>
    <?php } ?>
</div>
