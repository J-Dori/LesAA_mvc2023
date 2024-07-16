<?php
use App\Service\CommonFunctions;

if (isset($teamMembers) && !empty($teamMembers)) { ?>
<!-- Block Team -->
<section class="page-section" id="team">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Notre équipe</h2>
            <?php if (isset($headers) && !empty($headers->getTeamSubtitle())) { ?>
                <div class="mb-5">
                    <h3 class="section-subheading text-muted"><?= $headers->getTeamSubtitle() ?></h3>
                </div>
            <?php } ?>
        </div>
        <div class="row">
            <?php foreach ($teamMembers as $member) { ?>
                <div class="col-lg-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="<?= CommonFunctions::fileExists(IMG_TEAM, $member->getImgPath()) ?>" alt="<?= $member ?>" />
                        <h4 class="my-3"><?= $member ?></h4>
                        <span class="text-muted">
                            <?= $member->getRole() ?>
                            <?= $member->getDescription() ?>
                        </span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>
