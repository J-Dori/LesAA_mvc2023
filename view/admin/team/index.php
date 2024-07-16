<?php
    use App\Service\CommonFunctions;

    $team = $response["data"]["team"];

?>

<div class="container" id="admin-team-index">
    <div class="d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-md-between gap-2">
        <h3 class="text-uppercase text-muted text-center m-0">Liste des Membres</h3>
        <a class="btn btn-primary px-3 py-2 w-100 w-md-0" href="?ctrl=teamAdmin&action=form"><i class="fa-solid fa-square-plus"></i>&ensp;Membres</a>
    </div>
    <hr class="my-3 p-0">
    <div>
        <div class="row">
            <div class="col-lg-9 col-12 mx-auto">
                <table class="table table-striped">
                    <thead class="border-1 text-muted">
                    <tr>
                        <th style="width: 150px;"></th>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Nom</th>
                        <th>Rôle</th>
                        <th>Description</th>
                        <th style="width: 100px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($team)) {
                        foreach ($team as $member) { ?>
                        <tr class="align-middle">
                            <td>
                                <img class="w-100 h-auto p-3" src="<?= CommonFunctions::fileExists(IMG_TEAM, $member->getImgPath()) ?>" alt="Logo Partenaire">
                            </td>
                            <td class="text-center"><?= $member->getRoleOrder() ?></td>
                            <td><?= $member->getName() ?></td>
                            <td><?= $member->getRole() ?></td>
                            <td><?= $member->getDescription() ?></td>
                            <td class="text-center">
                                <a class="btn btn-dark px-2 py-1" title="Modifier" href="?ctrl=teamAdmin&action=form&id=<?= $member->getId() ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button id="del_<?= $member->getId() ?>" name="teamAdmin"
                                        class="btn--delete btn btn-danger px-2 py-1"
                                        title="Supprimer"
                                        data-bs-toggle="modal" data-bs-target="#modalDeleteConfirmation"
                                ><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>
                    <?php } } else { ?>
                        <tr>
                            <td colspan="3" class="text-muted text-center small">Aucun membre enregistré</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
