<?php
use App\Service\CommonFunctions;

$hideClass = isset($_GET['ctrl']) ? 'banner-hide' : '';
$showClass = isset($_GET['ctrl']) ? 'banner-show' : '';
$imgSize = isset($_GET['ctrl']) ? '350px' : '500px';
$pageTitle = $response["data"]["pageTitle"] ?? null;
?>

<header class="masthead">
    <div class="dark-bg-container"></div>
    <div class="container z-index-100">
        <?php if (isset($headers) && !empty($headers->getBannerTitle())) { ?>
            <div class="masthead-subheading <?= $hideClass ?>"><?= $headers->getBannerTitle() ?></div>
        <?php } ?>
        <div class="masthead-heading">
            <a href="/">
                <img class="w-100 h-auto" style="max-width: <?= $imgSize ?>;" src="<?= CommonFunctions::fileExists(LOGO_PATH, "main_logo.png") ?>" alt="Logo" />
            </a>

            <?php if (isset($headers) && !empty($headers->getBannerSubtitle())) { ?>
                <h1 class="mt-5 <?= $hideClass ?>"><?= $headers->getBannerSubtitle() ?></h1>
            <?php } ?>

            <?php if (!empty($pageTitle)) { ?>
                <h1 class="mt-3 <?= $showClass ?>"><?= $pageTitle ?></h1>
            <?php } ?>
        </div>
    </div>
</header>