<?php
    $actors = $response["data"]["actors"];
?>

<div class="container" id="admin-actor-index">
    <div class="d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-md-between gap-2">
        <h3 class="text-uppercase text-muted text-center m-0">Comédiens</h3>
        <a class="btn btn-primary px-3 py-2 w-100 w-md-0" href="?ctrl=actorAdmin&action=form"><i class="fa-solid fa-square-plus"></i>&ensp;Comédien</a>
    </div>
    <hr class="my-3 p-0">
    <div class="overflow-x-auto">
        <?php if (isset($actors) && !empty($actors)) { ?>
            <table class="table table-striped">
                <thead class="border-1 text-muted">
                <tr>
                    <th>Prénom</th>
                    <th>NOM</th>
                    <th>E-mail</th>
                    <th>Nº Téléphone</th>
                    <th style="width: 100px;"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($actors as $actor) { ?>
                <tr>
                    <td><?= $actor->getFirstname() ?></td>
                    <td><?= $actor->getLastname() ?></td>
                    <td><a class="text-muted" href="mailto:<?= $actor->getEmail() ?>"><?= $actor->getEmail() ?></a></td>
                    <td><a class="text-muted" href="tel:<?= $actor->getPhoneLink() ?>"><?= $actor->getPhone() ?></a></td>
                    <td class="text-center">
                        <a class="btn btn-dark px-2 py-1" title="Modifier" href="?ctrl=actorAdmin&action=form&id=<?= $actor->getId() ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        <button id="del_<?= $actor->getId() ?>" name="actorAdmin"
                                class="btn--delete btn btn-danger px-2 py-1"
                                title="Supprimer"
                                data-bs-toggle="modal" data-bs-target="#modalDeleteConfirmation"
                        ><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                <?php } ?>
                </tr>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>
