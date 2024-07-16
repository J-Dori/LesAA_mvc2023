<?php

use App\Service\CommonFunctions;

$play = $response["data"]["play"]; //play ID
$playRoles = $response["data"]["playRoles"] ?: null;
$contact = $response["data"]["contact"] ?? null; //online booking url in active Contact

if (isset($play) && !empty($play)) {
?>
<!-- Front Play -->
<section class="page-section" id="page-play">
    <div class="container">
        <div class="row text-center">
            <div class="col-12 col-lg-4">
                <img class="shadow w-100 h-auto" style="max-width: 500px;" src="<?= CommonFunctions::fileExists(IMG_PLAY_FLYERS, $play->getImgPath()) ?>" alt="Pièce" />
                <div class="text-center mx-auto mt-3">
                    <a class="btn btn-light rounded-2 w-100 px-5 py-3 shadow" href="?ctrl=home&action=playIndex">Nos Pièces</a>
                </div>
            </div>
            <div class="col-12 col-lg-8 mt-5 mt-lg-0">
                <h1 class="mt-5 mt-lg-0 text-uppercase"><?= $play->getTitle() ?></h1>
                <h3 class="mt-1 mb-5 text-uppercase"><?= $play->getYear() ?></h3>
                <span class="text-muted lead play-font-description">
                    <?= $play->getDescription() ?>
                </span>

                <!-- DATES | VIDEO URL | PLAY ROLES -->
                <div class="mt-5 d-flex flex-wrap justify-content-md-center justify-content-start align-items-center flex-md-row gap-5">
                    <!-- Dates -->
                    <div class="d-flex align-items-center mb-md-3">
                        <div class="flex-shrink-0">
                            <div class="p-2 rounded-2 shadow-sm" style="background-color: hsl(172,72%,56%)">
                                <svg style="width: 1.25rem; height: 1.25rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="#f9fafb" d="M17 1c0-.552-.447-1-1-1s-1 .448-1 1v2c0 .552.447 1 1 1s1-.448 1-1v-2zm-12 2c0 .552-.447 1-1 1s-1-.448-1-1v-2c0-.552.447-1 1-1s1 .448 1 1v2zm13 5v10h-16v-10h16zm2-6h-2v1c0 1.103-.897 2-2 2s-2-.897-2-2v-1h-8v1c0 1.103-.897 2-2 2s-2-.897-2-2v-1h-2v18h20v-18zm-11.646 14c-1.318 0-2.192-.761-2.168-2.205h1.245c.022.64.28 1.107.907 1.107.415 0 .832-.247.832-.799 0-.7-.485-.751-1.3-.751v-.977c.573.05 1.196-.032 1.196-.608 0-.455-.369-.663-.711-.663-.575 0-.793.422-.782 1.003h-1.256c.052-1.401.902-2.107 2.029-2.107.968 0 1.969.613 1.969 1.64 0 .532-.234.945-.638 1.147.528.203.847.681.847 1.293-.001 1.201-.993 1.92-2.17 1.92zm5.46 0h-1.306v-3.748h-1.413v-1.027c.897.024 1.525-.233 1.657-1.113h1.062v5.888zm10.186-11v19h-22v-2h20v-17h2z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-4">
                            <p class="mb-1 text-muted"><?= !empty($play->getInlineDates()) ? $play->getInlineDates() : 'Dates non définies ' ?></p>
                        </div>
                    </div>

                    <!-- Video URL -->
                    <?php if (!empty($play->getVideoPath())) { ?>
                        <div class="d-flex align-items-center mb-md-3">
                            <div class="flex-shrink-0">
                                <div class="p-2 rounded-2 shadow-sm" style="background-color: hsl(30,93%,60%)">
                                    <svg style="width: 1.25rem; height: 1.25rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path fill="#f9fafb" d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-4">
                                <p class="mb-1" style="text-align: left !important;">
                                    <a class="text-muted p-0" href="<?= $play->getVideoPath() ?>" target="_blank">Vidéo sur notre chaîne YouTube</a>
                                </p>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- Play Roles -->
                    <?php if (!empty($playRoles)) { ?>
                        <div class="d-flex align-items-center mb-md-3">
                            <div class="flex-shrink-0">
                                <div class="p-2 rounded-2 shadow-sm" style="background-color: hsl(207,97%,58%)">
                                    <svg style="width: 1.25rem; height: 1.25rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill-rule="evenodd" clip-rule="evenodd">
                                        <path fill="#f9fafb" d="M18.028 24h-.018c-.268 0-.49-.213-.499-.483-.05-1.462.19-2.847 2.265-3.08.795-.089.858-.367.996-.977.229-1.008.607-1.922 2.701-2.032.285-.02.512.197.526.473.014.276-.197.512-.473.526-1.512.079-1.618.547-1.778 1.254-.152.667-.359 1.581-1.861 1.751-1.016.113-1.432.423-1.377 2.051.01.276-.207.507-.482.517zm-8.342-18.714c.241.213.53.366.842.444l3.566.896c.3.076.617.051.903-.07 1.082-.461 3.862-1.684 5.062-2.155.76-.299 1.268.63.655 1.097-1.39 1.062-5.714 4.086-5.714 4.086l-.862 3.648s1.785 1.86 2.544 2.7c.423.469.696.919.421 1.595-.481 1.181-1.457 3.477-1.908 4.547-.255.605-1.164.453-1.015-.322.217-1.128.781-4.016.781-4.016l-3.558-1.62s-.253 5.953-.327 7.296c-.019.341-.253.589-.582.588-.249-.001-.508-.173-.612-.596-.534-2.178-2.142-8.99-2.142-8.99-.209-.837-.329-1.53-.053-2.564l.915-3.85s-2.726-3.984-3.709-5.476c-.402-.611.356-1.18.808-.78l3.985 3.542zm-7.178 8.489l-.853.511 2.708 4.524c-1.788.306-2.917 1.904-2.048 3.356.537.897 1.753 1.106 2.622.586 1.034-.619 1.774-1.952.979-3.284l-3.408-5.693zm17.721-5.193l.904 1.669 1.867.344-1.308 1.376.249 1.882-1.712-.819-1.713.819.25-1.882-1.309-1.376 1.867-.344.905-1.669zm-17.298-2.935l-2.934 2.935 2.934 2.935 2.935-2.935-2.935-2.935zm9.055-5.398c1.36-.626 2.972-.03 3.597 1.33.626 1.36.03 2.972-1.33 3.598-1.36.625-2.972.029-3.598-1.331-.625-1.36-.029-2.972 1.331-3.597z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-4">
                                <p class="mb-1">
                                    <button class="btn border-0 p-0 text-muted" type="button" data-bs-toggle="modal" data-bs-target="#modalPlayRoles">Liste des Rôles et Comédiens</button>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if ($play->getPlayStatusTitle() == 'En Scène' || $play->getDateStartMinus30Days()) { ?>
                    <div class="col-12 text-center mx-auto">
                        <h4 class="mt-5">Réservez votre place</h4>
                        <?php if (!empty($contact)) { ?>
                            <a class="btn btn-danger rounded mt-3 me-md-5 px-5 py-3 shadow" href="<?= $contact->getOnlineBooking() ?>" target="_blank">En ligne</a>
                        <?php } ?>
                        <a class="btn btn-secondary rounded mt-3 px-5 py-3 shadow" href="/#contact">E-mail / Téléphone</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($playRoles)) { include VIEW_PATH . 'home/play/modal_play_roles.php'; } ?>

<?php } ?>
