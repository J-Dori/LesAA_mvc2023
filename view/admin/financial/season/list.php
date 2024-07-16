<?php
    use App\Service\CommonFunctions;
    $seasons = $response["data"]["seasons"] ?? null;
?>

<div class="container-lg" id="admin-fin-season-list">
    <div class="d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-md-between gap-2">
        <div>
            <h3 class="text-uppercase text-muted text-center m-0">Trésorerie : Saisons</h3>
        </div>
        <div>
            <a class="btn btn-primary px-3 py-2 w-100 w-md-0" href="?ctrl=finSeasonAdmin&action=form"><i class="fa-solid fa-square-plus"></i>&ensp;Saison</a>
            <a class="btn btn-secondary px-3 py-2 w-100 w-md-0 mt-3 mt-md-0" href="?ctrl=finCategoryAdmin&action=index"><i class="fa-solid fa-folder-open"></i>&ensp;Catégories</a>
        </div>
    </div>
    <hr class="my-3 p-0">
    <?php if (isset($seasons) && !empty($seasons)) { ?>
        <div class="overflow-x-auto">
            <table class="table table-striped">
                <thead class="border-1 text-muted">
                <tr>
                    <th class="text-center">Année</th>
                    <th>Pièce</th>
                    <th class="text-end">Solde Initial</th>
                    <th class="text-end">Solde Final</th>
                    <th class="text-end">Solde Prévu</th>
                    <th style="width: 100px;"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($seasons as $season) { ?>
                <tr class="<?= $season->isActive() ? 'bg-active-row' : '' ?>">
                    <td class="text-center"><?= $season->getYear() ?></td>
                    <td><?= $season->getPlayTitle() ?></td>
                    <td class="text-end"><?= CommonFunctions::convertToMoney($season->getBudgetStart()) ?></td>
                    <td class="text-end"><?= CommonFunctions::convertToMoney($season->getBudgetEnd()) ?></td>
                    <td class="text-end"><?= CommonFunctions::convertToMoney(($season->getBudgetEnd() - $season->getBudgetStart())) ?></td>
                    <td class="text-center">
                        <a class="btn btn-dark px-2 py-1" title="Modifier" href="?ctrl=finSeasonAdmin&action=form&id=<?= $season->getId() ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        <button id="del_<?= $season->getId() ?>" name="finSeasonAdmin"
                                class="btn--delete btn btn-danger px-2 py-1"
                                title="Supprimer"
                                data-bs-toggle="modal" data-bs-target="#modalDeleteConfirmation"
                        ><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                <?php } ?>
                </tr>
                </tbody>
            </table>

            <div class="my-5 text-center text-muted">
                <p>
                    <span class="text-danger fw-bold">Attention !</span>
                    <br>
                    Si vous <span class="text-danger fw-bold">supprimez</span> une Saison, tous les revenus et dépenses associés seront supprimés
                </p>
            </div>
        </div>
    <?php } else { ?>
        <div class="text-center my-5">
            <h3 class="text-danger">Aucune saison enregistrée</h3>
            <p class="text-muted">Pour continuer, créez une saison et cochez l'option "Saison Active".</p>
        </div>
    <?php } ?>
</div>
