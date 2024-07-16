<?php
use App\Service\CommonFunctions;
$article = $response["data"]["article"] ?? null;
?>

<section id="blog-article" class="container py-5 px-3">
    <div class="row align-items-center">
        <div class="col-12 col-md-6 col-lg-3 order-md-first order-last">
            <img class="img-fluid rounded-5 shadow hover-shadow p-2 imageSlide cursor-pointer"
                 src="<?= CommonFunctions::fileExists(IMG_BLOG, $article->getImgPath()) ?>"
                 alt="Actualités : <?= $article->getTitle() ?>"
                 onclick="openModal();currentSlide(1)"
                 data-slide-number="1"
                 data-slide-caption="<?= $article->getTitle() ?>"
            >
        </div>
        <div class="col-12 col-md-6 col-lg-9 mt-md-5 mb-5 mb-md-0 mt-md-2 text-center text-md-start">
            <h2><?= $article->getDate() ?></h2>
            <h2 class="mb-3"><?= $article->getTitle() ?></h2>

            <span class="db-ta"><?= $article->getText() ?></span>
        </div>
    </div>
    
</section>
