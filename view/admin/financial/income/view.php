<?php
    use App\Service\CommonFunctions;
    $season = $response["data"]["season"] ?? null;
    $income = $response["data"]["income"] ?? null;
    $returnToCtrl = $_GET['return'] ?? 'finIncome';
?>

<div class="container" id="admin-fin-income-view">
    <div class="col-lg-8 col-12 mx-auto p-lg-5 p-3 border-light shadow">
        <div class="row text-center mx-auto mb-3">
            <h4 class="text-success text-uppercase">Revenu</h4>
            <h4>Saison <?= $season->getYear() ?? '' ?></h4>
            <p class="text-muted"><?= $season->getPlay() ? $season->getPlayTitle() : '' ?></p>
            <hr class="mt-3">
        </div>

        <div class="row justify-content-between mb-3">
            <div class="col-6">
                <p class="text-muted"><strong>Revenu nº : </strong><?= $income->getFinNumber() ?></p>
            </div>
            <div class="col-6">
                <p class="text-muted text-end"><strong>Date : </strong><?= $income->getDate() ?></p>
            </div>
        </div>

        <div class="row mb-3">
            <p class="text-muted"><strong>Catégorie : </strong><?= $income->getFinCategory() ?></p>
        </div>

        <div class="row mb-5">
            <p class="text-muted"><strong>Description : </strong></p>
            <?= CommonFunctions::convertToHTMLAndTrim($income->getDescription()) ?>
        </div>

        <div class="row mb-5 justify-content-between">
            <div class="col-4">
                <p class="text-muted"><strong>Mode Paiement : </strong><?= $income->getMop() ?></p>
            </div>
            <div class="col-4 text-center">
                <p class="text-muted"><strong>Montant : </strong><?= CommonFunctions::convertToMoney($income->getAmount()) ?></p>
            </div>
            <div class="col-4 text-end">
                <p class="text-muted"><strong>Doc/Ref : </strong><?= $income->getDocRef() ?></p>
            </div>
        </div>

        <div class="row">
            <?php if (!empty($income->getCreatedBy()) || (!empty($income->getUpdatedBy()))) { ?>
                <div class="d-flex flex-wrap justify-content-lg-between justify-content-center mb-3" style="font-size: 10px">
                    <div class="col-lg-6 col-12">
                        <p class="text-muted">Créé par:&ensp;<?= $income->getCreatedBy() ?></p>
                        <p class="text-muted">Le:&ensp;<?= $income->getCreatedAt() ?></p>
                    </div>
                    <div class="col-lg-6 col-12 text-lg-end mt-3 mt-lg-0">
                        <?php if (!empty($income->getUpdatedBy())) { ?>
                            <p class="text-muted">Modifié par:&ensp;<?= $income->getUpdatedBy() ?: ' - ' ?></p>
                            <p class="text-muted">Le:&ensp;<?= $income->getUpdatedAt() ?: ' - ' ?></p>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="row text-center mx-auto">
            <a class="px-5 py-2 text-danger fw-bold" href="?ctrl=<?= $returnToCtrl ?>Admin&action=index">Fermer</a>
        </div>

    </div>
</div>
