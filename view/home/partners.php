<?php
use App\Service\CommonFunctions;

if (isset($partners) && !empty($partners)) { ?>
<!-- Partners -->
<section class="page-section" id="partners">
    <div class="container">
        <div class="text-center">
            <h3 class="section-heading text-uppercase">Partenariat</h3>
            <?php if (isset($headers) && !empty($headers)) { ?>
                <div class="mb-5">
                    <h3 class="section-subheading text-muted"><?= $headers->getPartnersSubtitle() ?></h3>
                </div>
            <?php } ?>
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <?php foreach ($partners as $partner) { ?>
                <img class="partners-logo w-auto px-3" style="height: 75px;" src="<?= CommonFunctions::fileExists(LOGO_PATH, $partner->getImgPath()) ?>" alt="Wishes" title="<?= $partner->getName() ?>"/>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>
