<?php

use App\Service\CommonFunctions;

$blog = $response["data"]["blog"] ?? null;
$headers = $response["data"]["headers"] ?? null;

?>

<section id="index-blog-cards" class="container py-5 px-3">
    <div class="text-center">
        <h2 class="section-heading text-uppercase">Notre Actualité</h2>
        <?php if (isset($headers) && !empty($headers)) { ?>
            <div class="mb-5">
                <h3 class="section-subheading text-muted">
                    <?= $headers->getBlogSubtitle() ?>
                </h3>
            </div>
        <?php } ?>
    </div>

    <div class="row">
        <?php foreach ($blog as $article) { ?>
            <div class="col-md-6 col-lg-4 mt-5">
                <div class="card blog-card">
                    <div class="card-img-block">
                        <!-- background-image url -->
                        <div class="card-img-background" style="background-image: url('<?= CommonFunctions::fileExists(IMG_BLOG, $article->getImgPath()) ?>')"></div>
                    </div>
                    <div class="card-body pt-0">
                        <h3><?= $article->getDate() ?></h3>
                        <h5><?= $article->getTitle() ?></h5>
                        <a class="btn btn-sm btn-primary px-3 py-2 mt-3" href="<?= '?ctrl=home&action=article&id=' . $article->getId() ?>">Ouvrir l'article</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
