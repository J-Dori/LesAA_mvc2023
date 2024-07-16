<?php

$blog = $response["data"]["blog"] ?? null;
$headers = $response["data"]["headers"] ?? null;

?>

<div class="container" id="admin-blog-preview">

    <div class="d-flex flex-wrap justify-content-lg-between justify-content-center align-items-center">
        <h3 class="text-uppercase text-muted text-center mb-3 mb-lg-0">Article&ensp;<i class="fa fa-eye text-info"></i></h3>
        <div class="d-flex flex-wrap justify-content-lg-end justify-content-center align-items-center gap-3 w-lg-0 w-100">
            <a class="col-12 col-lg-auto btn btn-info px-3 py-2" href="?ctrl=blogAdmin&action=index">Liste</a>
            <a class="col-12 col-lg-auto btn btn-primary px-3 py-2" href="?ctrl=blogAdmin&action=form"><i class="fa-solid fa-square-plus"></i>&ensp;Article</a>
        </div>
    </div>

    <hr class="my-3 p-0">

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
        <div class="col-md-6 col-lg-3 mt-4">
            <div class="card blog-card">
                <div class="card-img-block">
                    <!-- background-image url -->
                    <div class="card-img-background" style="background-image: url('<?= IMG_BLOG . $article->getImgPath() ?>')"></div>
                </div>
                <div class="card-body pt-0">
                    <h3><?= $article->getDate() ?></h3>
                    <h4><?= $article->getTitle() ?></h4>
                    <a class="btn btn-sm btn-primary px-3 py-2 mt-3" href="<?= '?ctrl=blog&action=article&id=' . $article->getId() ?>">Ouvrir l'article</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

