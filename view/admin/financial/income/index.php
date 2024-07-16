<?php
    use App\Service\CommonFunctions;
    $season = $response["data"]["season"] ?? null;
    $incomes = $response["data"]["incomes"] ?? null;
    $totalIncomes = $response["data"]["totalIncomes"] ?? 0;
    $totalByCategory = $response["data"]["totalByCategory"] ?? null;
    $totalByMop = $response["data"]["totalByMop"] ?? null;

    $filterName = $_GET['filterBy'] ?? 'finNumber';
?>

<div class="container-lg" id="admin-fin-income-index">
    <div class="row">
        <div class="d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-md-between gap-2">
            <div>
                <h3 class="text-uppercase text-muted text-center m-0">Trésorerie : Revenus</h3>
            </div>
            <div>
                <a class="btn btn-success px-3 py-2 w-100 w-md-0" href="?ctrl=finIncomeAdmin&action=form"><i class="fa-solid fa-square-plus"></i>&ensp;Revenu</a>
                <a class="btn btn-secondary px-3 py-2 w-100 w-md-0 mt-3 mt-md-0" href="?ctrl=finCategoryAdmin&action=index"><i class="fa-solid fa-folder-open"></i>&ensp;Catégories</a>
                <a class="btn btn-secondary px-3 py-2 w-100 w-md-0 mt-3 mt-md-0" href="?ctrl=finSeasonAdmin&action=index"><i class="fa-solid fa-hand-point-left"></i>&ensp;Trésorerie</a>
            </div>
        </div>
        <hr class="my-3 p-0">
    </div>
    <div class="row my-3">
        <h4>Saison <?= $season->getYear() ?? '' ?></h4>
        <p class="text-muted"><?= $season->getPlay() ? $season->getPlayTitle() : '' ?></p>
    </div>
    <?php if (isset($incomes) && !empty($incomes)) { ?>
        <div class="overflow">
            <div class="row">
                <table class="table table-striped">
                    <thead class="border-1 text-muted">
                    <tr>
                        <th class="bg-success text-white p-2" colspan="3">Revenus</th>
                        <th class="bg-success text-white text-end p-2" colspan="3"><?= CommonFunctions::convertToMoney($totalIncomes) ?></th>
                        <th class="bg-success" style="width: 140px"></th>
                    </tr>
                    <tr style="font-size: 12px">
                        <th class="text-center" style="width: 75px;">
                            <a href="?ctrl=finIncomeAdmin&action=index&filterBy=finNumber"
                               class="<?= $filterName == 'finNumber' ? '' : 'text-muted' ?>">
                                <i class="fa-solid fa-arrow-down-wide-short"></i>&ensp;Nº
                            </a>
                        </th>
                        <th class="text-center">
                            <a href="?ctrl=finIncomeAdmin&action=index&filterBy=date"
                               class="<?= $filterName == 'date' ? '' : 'text-muted' ?>">
                                <i class="fa-solid fa-arrow-down-wide-short"></i>&ensp;Date
                            </a>
                        </th>
                        <th>
                            <a href="?ctrl=finIncomeAdmin&action=index&filterBy=category"
                               class="<?= $filterName == 'category' ? '' : 'text-muted' ?>">
                                <i class="fa-solid fa-arrow-up-wide-short"></i>&ensp;Catégorie
                            </a>
                        </th>
                        <th>Description</th>
                        <th class="text-center">
                            <a href="?ctrl=finIncomeAdmin&action=index&filterBy=mop"
                               class="<?= $filterName == 'mop' ? '' : 'text-muted' ?>">
                                <i class="fa-solid fa-arrow-up-wide-short"></i>&ensp;MP
                            </a>
                        </th>
                        <th class="text-end">
                            <a href="?ctrl=finIncomeAdmin&action=index&filterBy=amount"
                               class="<?= $filterName == 'amount' ? '' : 'text-muted' ?>">
                                <i class="fa-solid fa-arrow-down-wide-short"></i>&ensp;Montant
                            </a>
                        </th>
                        <th style="width: 140px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($incomes as $income) { ?>
                        <tr>
                            <td class="text-center"><?= $income->getFinNumber() ?></td>
                            <td class="text-center"><?= $income->getDate() ?></td>
                            <td><?= $income->getFinCategory() ?></td>
                            <td><?= CommonFunctions::convertToHTMLAndTrim($income->getDescription(), 100) ?></td>
                            <td class="text-center"><?= $income->getMop() ?></td>
                            <td class="text-end"><?= CommonFunctions::convertToMoney($income->getAmount()) ?></td>
                            <td class="text-end">
                                <a class="btn p-2" title="Ouvrir" href="?ctrl=finIncomeAdmin&action=view&id=<?= $income->getId() ?>&return=finIncome"><i class="fa-solid fa-eye"></i></a>
                                <a class="btn px-2 py-1" title="Modifier" href="?ctrl=finIncomeAdmin&action=form&id=<?= $income->getId() ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button id="del_<?= $income->getId() ?>" name="finIncomeAdmin"
                                        class="btn--delete btn px-2 py-1"
                                        title="Supprimer"
                                        data-bs-toggle="modal" data-bs-target="#modalDeleteConfirmation"
                                ><i class="fa-solid fa-trash-can text-danger"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="row mt-5">

                <?php if ($totalByCategory) { ?>
                <!-- TOTAL BY CATEGORY -->
                <div class="p-3 shadow col-12 col-md-6 mx-auto">
                    <h4 class="text-center">Montants par Catégorie</h4>
                    <table class="table table-striped">
                        <thead>
                        <tr class="text-muted" style="font-size: 12px">
                            <th>Catégorie</th>
                            <th class="text-end">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($totalByCategory as $categ) { ?>
                            <tr>
                                <td><?= $categ->getFinCategory() ?>&ensp;<?= $categ->getCountByCategory() ? '(' . $categ->getCountByCategory() . ')' : '' ?></td>
                                <td class="text-end"><?= CommonFunctions::convertToMoney($categ->getTotalByCategory()) ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfooter>
                            <tr>
                                <td colspan="2">
                                    <a style="font-size: 12px" class="link-secondary" title="Imprimer"
                                       target="_blank"
                                       href="?ctrl=finIncomeAdmin&action=print&type=category">
                                        <i class="fa-solid fa-print"></i>&ensp;Imprimer
                                    </a>
                                </td>
                            </tr>
                        </tfooter>
                    </table>
                </div>
                <?php } ?>

                <?php if ($totalByMop) { ?>
                    <!-- TOTAL BY MOP -->
                    <div class="p-3 shadow mt-3 col-12 mt-md-0 col-md-6 mx-auto">
                        <h4 class="text-center">Montants par MP</h4>
                        <table class="table table-striped">
                            <thead>
                            <tr class="text-muted" style="font-size: 12px">
                                <th>MP</th>
                                <th class="text-end">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($totalByMop as $mop) { ?>
                                <tr>
                                    <td><?= $mop->getMop() ?>&ensp;<?= $mop->getCountByMop() ? '(' . $mop->getCountByMop() . ')' : '' ?></td>
                                    <td class="text-end"><?= CommonFunctions::convertToMoney($mop->getTotalByMop()) ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
            </div>

        </div>
    <?php } else { ?>
        <div class="text-center my-5">
            <p class="text-muted">Aucun revenu enregistré dans la saison active</p>
        </div>
    <?php } ?>
</div>
