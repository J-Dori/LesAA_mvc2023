<?php
    use App\Service\CommonFunctions;
    $season = $response["data"]["season"] ?? null;
    $incomes = $response["data"]["incomes"] ?? null;
    $expenses = $response["data"]["expenses"] ?? null;
    $totalIncomes = $response["data"]["totalIncomes"] ?? 0;
    $totalExpenses = $response["data"]["totalExpenses"] ?? 0;
?>

<div class="container-lg" id="admin-fin-season-index">
    <div class="d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-md-between gap-2">
        <div>
            <h3 class="text-uppercase text-muted text-center m-0">Trésorerie : Saisons</h3>
        </div>
        <div>
            <a class="btn btn-primary px-3 py-2 w-100 w-md-0" href="?ctrl=finSeasonAdmin&action=seasonList"><i class="fa-solid fa-folder-open"></i>&ensp;Saisons</a>
            <?php if (isset($season) && !empty($season)) { ?>
                <a class="btn btn-secondary px-3 py-2 w-100 w-md-0 mt-3 mt-md-0" href="?ctrl=finCategoryAdmin&action=index"><i class="fa-solid fa-folder-open"></i>&ensp;Catégories</a>
            <?php } ?>
        </div>
    </div>

    <hr class="my-3 p-0">

    <?php if (isset($season) && !empty($season)) { ?>
        <div class="row">
            <!-- SEASON'S SOLDE -->
            <div class="col-12 col-lg-6 mt-3">
                <div class="shadow p-3">
                    <h4>Saison <?= $season->getYear() ?? '' ?></h4>
                    <p class="text-muted"><?= $season->getPlay() ? $season->getPlayTitle() : '' ?></p>
                    <hr>
                    <div class="row fw-bold">
                        <div class="col">
                            <p class="text-success">Solde Initial</p>
                            <p class="text-danger">Solde Final</p>
                            <p class="mt-2">Solde Saison</p>
                        </div>
                        <div class="col text-end">
                            <p class="text-success"><?= CommonFunctions::convertToMoney($season->getBudgetStart()) ?></p>
                            <p class="text-danger"><?= CommonFunctions::convertToMoney($season->getBudgetEnd()) ?></p>
                            <p class="mt-2"><?= CommonFunctions::convertToMoney(($season->getBudgetEnd() - $season->getBudgetStart())) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TOTALS -->
            <div class="col-12 col-lg-6 mt-3">
                <div class="shadow p-3">
                    <h4 class="text-lg-end">Totaux</h4>
                    <p class="text-muted text-lg-end">Soustraction des dépenses sur les revenus</p>
                    <hr>
                    <div class="row fw-bold">
                        <div class="col">
                            <p class="text-success">Revenus</p>
                            <p class="text-danger">Dépenses</p>
                            <p class="mt-2 fw-bold">Total</p>
                        </div>
                        <div class="col text-end">
                            <p class="text-success"><?= CommonFunctions::convertToMoney($totalIncomes) ?></p>
                            <p class="text-danger"><?= CommonFunctions::convertToMoney($totalExpenses) ?></p>
                            <p class="mt-2"><?= CommonFunctions::convertToMoney(($totalIncomes - $totalExpenses)) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- INCOMES -->
            <div class="col-12 col-lg-6 mt-5">
                <table class="table table-striped">
                    <thead class="border-1 text-muted">
                        <tr>
                        <th class="bg-success p-2" colspan="3">
                            <a class="text-white w-100" title="Ouvrir Revenus" href="?ctrl=finIncomeAdmin&action=index">
                                <i class="fa-solid fa-folder-open"></i>&ensp;Revenus
                            </a>
                        </th>
                        <th class="bg-success text-white text-end p-2" colspan="3"><?= CommonFunctions::convertToMoney($totalIncomes) ?></th>
                        </tr>
                    <tr style="font-size: 12px">
                        <th style="width: 50px;"></th>
                        <th class="text-center" style="width: 50px;">Nº</th>
                        <th class="text-center"><i class="fa-solid fa-arrow-down-wide-short"></i>&ensp;Date</th>
                        <th>Catégorie</th>
                        <th class="text-center">MP</th>
                        <th class="text-end">Montant</th>
                    </tr>
                    </thead>
                    <tbody style="font-size: 12px">
                    <?php foreach ($incomes as $income) { ?>
                        <tr>
                            <td class="text-center">
                                <a class="btn p-2" title="Ouvrir" href="?ctrl=finIncomeAdmin&action=view&id=<?= $income->getId() ?>&return=finSeason"><i class="fa-solid fa-eye"></i></a>
                            </td>
                            <td class="text-center"><?= $income->getFinNumber() ?></td>
                            <td class="text-center"><?= $income->getDate() ?></td>
                            <td><?= $income->getFinCategory() ?></td>
                            <td class="text-center"><?= $income->getMop() ?></td>
                            <td class="text-end"><?= CommonFunctions::convertToMoney($income->getAmount()) ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- EXPENSES -->
            <div class="col-12 col-lg-6 mt-5">
                <table class="table table-striped">
                    <thead class="border-1 text-muted">
                    <tr>
                        <th class="bg-danger p-2" colspan="3">
                            <a class="text-white w-100" title="Ouvrir Dépenses" href="">
                                <i class="fa-solid fa-folder-open"></i>&ensp;Dépenses
                            </a>
                        </th>
                        <th class="bg-danger text-white text-end p-2" colspan="3"><?= CommonFunctions::convertToMoney($totalExpenses) ?></th>
                    </tr>
                    <tr style="font-size: 12px">
                        <th style="width: 50px;"></th>
                        <th class="text-center" style="width: 50px;">Nº</th>
                        <th class="text-center"><i class="fa-solid fa-arrow-down-wide-short"></i>&ensp;Date</th>
                        <th>Catégorie</th>
                        <th class="text-center">MP</th>
                        <th class="text-end">Montant</th>
                    </tr>
                    </thead>
                    <tbody style="font-size: 12px">
                    <?php foreach ($expenses as $expense) { ?>
                        <tr>
                            <td class="text-center">
                                <a class="btn p-2" title="Ouvrir" href="?ctrl=finSeasonAdmin&action=form&id=<?= $expense->getId() ?>"><i class="fa-solid fa-eye"></i></a>
                            </td>
                            <td class="text-center"><?= $expense->getFinNumber() ?></td>
                            <td class="text-center"><?= $expense->getDate() ?></td>
                            <td><?= $expense->getFinCategory() ?></td>
                            <td class="text-center"><?= $expense->getMop() ?></td>
                            <td class="text-end"><?= CommonFunctions::convertToMoney($expense->getAmount()) ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php } else { ?>
        <div class="text-center my-5">
            <h3 class="text-danger">Aucune saison ouverte</h3>
            <p class="text-muted">Pour continuer, ouvrez la liste des saisons et cochez l'option "Saison Active".</p>
        </div>
    <?php } ?>
</div>
