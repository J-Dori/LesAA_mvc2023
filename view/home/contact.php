<?php if (isset($blockContact) && !empty($blockContact)) { ?>
    <!-- Block Contact -->
    <section class="page-section position-relative" id="contact">
        <div class="dark-bg-container"></div>
        <div class="container z-index-100">
            <div class="mb-5 text-center">
                <h2 class="section-heading text-uppercase">Contacts</h2>
            </div>
            <div class="row align-items-center text-center text-white">
                <div class="col-md-3">
                    <?php if (!empty($blockContact->getPostPhone())) { ?>
                        <h5 class="text-uppercase">Par téléphone</h5>
                        <p><?= $blockContact->getResponsableName() ?></p>
                        <a href="tel:<?= $blockContact->getPostPhoneLink() ?>"><?= $blockContact->getPostPhone() ?></a>
                    <?php } ?>

                    <?php if (!empty($blockContact->getEmail())) { ?>
                        <h5 class="text-uppercase mt-5">Par E-mail</h5>
                        <a href="mailto:<?= $blockContact->getEmail() ?>"><?= $blockContact->getEmail() ?></a>
                    <?php } ?>
                </div>
                <div class="col-md-9 mt-md-0 mt-5">
                    <h5 class="text-uppercase">Localisation</h5>
                    <span class="db-ta"><?= $blockContact->getTheaterAddress() ?></span>

                    <?php if (!empty($blockContact->getTheaterMapLink())) { ?>
                        <iframe src="<?= $blockContact->getTheaterMapLink() ?>" style="max-width: 100%; width: 650px; height: 300px; border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

<?php } ?>
