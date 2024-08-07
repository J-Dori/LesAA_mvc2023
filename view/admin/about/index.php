<?php
    use App\Service\CommonFunctions;

    $about = $response["data"]["about"];
    $headers = $response["data"]["headers"] ?? null;

?>

<div class="container" id="admin-about-index">
    <div class="d-flex flex-wrap justify-content-lg-between justify-content-center align-items-center">
        <h3 class="text-uppercase text-muted text-center w-lg-0 w-100">Liste du Parcours</h3>
        <div class="d-flex flex-wrap justify-content-lg-end justify-content-center align-items-center gap-3 w-lg-0 w-100">
            <a class="col-12 col-lg-auto btn btn-info px-3 py-2" href="?ctrl=aboutAdmin&action=preview">Aperçu</a>
            <a class="col-12 col-lg-auto btn btn-primary px-3 py-2" href="?ctrl=aboutAdmin&action=form"><i class="fa-solid fa-square-plus"></i>&ensp;Parcours</a>
        </div>
    </div>

    <hr class="my-3 p-0">

    <div>
        <div class="row px-lg-5">
            <h5>
                <a class="btn btn-dark px-2 py-1" title="Modifier" href="?ctrl=headersAdmin&action=index#tag_aboutHeaders">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                &ensp;En-têtes actuels
            </h5>
            <h6 class="text-muted mt-3">Sous titre</h6>
            <?= $headers->getAboutSubtitle() ?>
            <br>
            <h6 class="text-muted mt-3">Pied de page</h6>
            <?= $headers->getAboutFooter() ?>
        </div>

        <div class="row mt-5 overflow-x-auto">
            <div class="col mx-auto">
                <table class="table table-striped">
                    <thead class="border-1 text-muted">
                    <tr>
                        <th style="width: 150px;"></th>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Date/Période</th>
                        <th>Titre</th>
                        <th>Texte</th>
                        <th style="width: 100px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($about)) {
                        foreach ($about as $timeline) { ?>
                        <tr class="align-middle">
                            <td class="p-3">
                                <img class="rounded-circle img-fluid shadow-sm p-1" src="<?= CommonFunctions::fileExists(IMG_ABOUT, $timeline->getImgPath()) ?>" alt="Logo Partenaire">
                            </td>
                            <td class="text-center">
                                <span class="badge bg-<?= $timeline->isActive() ? 'success' : 'danger' ?>"><?= $timeline->getTimeOrder() ?></span>
                            </td>
                            <td><?= $timeline->getDate() ?></td>
                            <td><?= $timeline->getTitle() ?></td>
                            <td><?= $timeline->getText() ?></td>
                            <td class="text-center">
                                <a class="btn btn-dark px-2 py-1" title="Modifier" href="?ctrl=aboutAdmin&action=form&id=<?= $timeline->getId() ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button id="del_<?= $timeline->getId() ?>" name="aboutAdmin"
                                        class="btn--delete btn btn-danger px-2 py-1"
                                        title="Supprimer"
                                        data-bs-toggle="modal" data-bs-target="#modalDeleteConfirmation"
                                ><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>
                    <?php } } else { ?>
                        <tr>
                            <td colspan="3" class="text-muted text-center small">Aucun parcours enregistré</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    <tfooter>
                        <tr class="bg-light">
                            <td></td>
                            <td class="text-center">
                                <span class="badge bg-success">Affiché</span>
                                <br>
                                <span class="badge bg-danger">Masqué</span>
                            </td>
                            <td colspan="4"></td>
                        </tr>
                    </tfooter>
                </table>
            </div>
        </div>
    </div>
</div>
