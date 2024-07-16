<?php
    use App\Service\CommonFunctions;

    $partners = $response["data"]["partners"];

?>

<div class="container" id="admin-partners-index">
    <div class="d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-md-between gap-2">
        <h3 class="text-uppercase text-muted text-center m-0">Liste de Partenaires</h3>
        <a class="btn btn-primary px-3 py-2 w-100 w-md-0" href="?ctrl=partnersAdmin&action=form"><i class="fa-solid fa-square-plus"></i>&ensp;Partenaire</a>
    </div>
    <hr class="my-3 p-0">
    <div>
        <div class="row">
            <div class="col-lg-9 col-12 mx-auto">
                <table class="table table-striped">
                    <thead class="border-1 text-muted">
                    <tr>
                        <th style="width: 150px;"></th>
                        <th>Nom / Titre</th>
                        <th style="width: 100px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($partners)) {
                        foreach ($partners as $partner) { ?>
                        <tr class="align-middle">
                            <td>
                                <img class="w-100 h-auto p-3" src="<?= CommonFunctions::fileExists(LOGO_PATH, $partner->getImgPath()) ?>" alt="Logo Partenaire">
                            </td>
                            <td><?= $partner->getName() ?></td>
                            <td class="text-center">
                                <a class="btn btn-dark px-2 py-1" title="Modifier" href="?ctrl=partnersAdmin&action=form&id=<?= $partner->getId() ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button id="del_<?= $partner->getId() ?>" name="partnersAdmin"
                                        class="btn--delete btn btn-danger px-2 py-1"
                                        title="Supprimer"
                                        data-bs-toggle="modal" data-bs-target="#modalDeleteConfirmation"
                                ><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>
                    <?php } } else { ?>
                        <tr>
                            <td colspan="3" class="text-muted text-center small">Aucun partenaire enregistré</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
