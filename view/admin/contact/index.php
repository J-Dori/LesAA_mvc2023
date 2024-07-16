<?php
    $contacts = $response["data"]["contacts"] ?? false;
?>

<div class="container" id="admin-contact-index">
    <div class="d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-md-between gap-2">
        <h3 class="text-uppercase text-muted text-center m-0">Contacts</h3>
        <a class="btn btn-primary px-3 py-2 w-100 w-md-0" href="?ctrl=contactAdmin&action=formContact"><i class="fa-solid fa-square-plus"></i>&ensp;Contact</a>
    </div>
    <hr class="my-3 p-0">

    <?php if (isset($contacts) && !empty($contacts)) { ?>
        <div class="row gap-5 justify-content-between">
            <?php foreach ($contacts as $contact) { ?>
                <div class="col-12 col-lg-5">
                    <div class="card">
                        <a href="?ctrl=contactAdmin&action=formContact&id=<?= $contact->getId() ?>" class="">
                            <div class="d-flex justify-content-between align-items-center card-header <?= $contact->isActive() ? 'bg-info text-white' : 'text-muted' ?>">
                                <h5 class="m-0 p-0"><?= $contact->getResponsableName() ?></h5>
                                <small>Modifier</small>
                            </div>
                        </a>
                        <div class="card-body">
                            <p class="card-text"><strong>Adresse : </strong><?= $contact->getPostAddress() ?></p>
                            <p class="card-text"><strong>Téléphone : </strong><?= $contact->getPostPhone() ?></p>
                            <p class="card-text"><strong>E-mail : </strong><?= $contact->getEmail() ?></p>
                            <hr class="my-2">
                            <p class="card-text"><strong>Nom Salle : </strong><?= $contact->getTheaterName() ?></p>
                            <p class="card-text"><strong>Adresse Salle : </strong><?= $contact->getTheaterAddress() ?></p>
                            <p class="card-text"><strong>URL Google Maps : </strong>
                                <?php if ($contact->getTheaterMapLink()) { ?>
                                    <a href="<?= $contact->getTheaterMapLink() ?>" class="btn-link p-2" target="_blank">Ouvrir lien</a>
                                <?php } else { ?>
                                    <small class="text-muted"><i>Aucune URL enregistrée</i></small>
                                <?php } ?>
                            </p>

                            <p class="card-text"><strong>URL Réservations : </strong>
                                <?php if ($contact->getOnlineBooking()) { ?>
                                    <a href="<?= $contact->getOnlineBooking() ?>" class="btn-link p-2" target="_blank">Ouvrir lien</a>
                                <?php } else { ?>
                                    <small class="text-muted"><i>Aucune URL enregistrée</i></small>
                                <?php } ?>
                            </p>

                            <a href="<?= $contact->isActive() ? '#' : '?ctrl=contactAdmin&action=setActive&id='.$contact->getId() ?>" class="btn px-4 py-2 <?= $contact->isActive() ? 'disabled btn-info' : 'btn-secondary' ?>">
                                <?= $contact->isActive() ? 'En évidence' : 'Mettre en évidence' ?>
                            </a>
                        </div>

                        <div class="card-footer bg-danger text-center text-white">
                            <button id="del_<?= $contact->getId() ?>" name="contactAdmin"
                                    class="btn btn--delete w-100 p-0"
                                    title="Supprimer"
                                    data-bs-toggle="modal" data-bs-target="#modalDeleteConfirmation"
                            >Supprimer</button>
                        </div>

                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>
