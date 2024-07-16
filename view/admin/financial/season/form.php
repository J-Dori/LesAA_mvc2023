<?php
    use App\Service\CommonFunctions;

    $editMode = $response["data"]["editMode"] ?? null;
    $playsList = $response["data"]["playsList"] ?? null;

    $year = $response["data"]["year"] ?? null;
    $play = $response["data"]["play"] ?? null;
    $budgetStart = $response["data"]["budgetStart"] ?? null;
    $budgetEnd = $response["data"]["budgetEnd"] ?? null;
    $active = $response["data"]["active"] ?? null;
    $createdBy = $response["data"]["createdBy"] ?? null;
    $updatedBy = $response["data"]["updatedBy"] ?? null;
?>

<div class="container" id="admin-fin-manager-form">
    <div class="text-center mb-3">
        <h3 class="text-uppercase text-muted">Formulaire Saisons</h3>
        <p class="mb-0"><small class="text-danger "><strong>Champs obligatoires :</strong></small></p>
        <p><small class="text-muted">Année et Pièce</small></p>
    </div>

    <div class="col-lg-8 col-12 mx-auto p-lg-5 p-3 border-light shadow">
        <form action="?ctrl=finSeasonAdmin&action=form<?= $editMode ?>" method="POST" enctype="multipart/form-data">
            <!-- YEAR / PLAY -->
            <div class="row">
                <div class="col-lg-4 form-group mb-3">
                    <label class="form-label text-required" for="year">Année</label>
                    <input type="number" class="form-control" name="year" maxlength="4"  id="year" value="<?= $year ?>" placeholder="ex: 2023" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="form-label form-label text-required" for="play">Pièce</label>
                    <select class="form-select" id="play" name="play" required>
                        <option <?= empty($editMode) ?? 'selected' ?>>Liste des Pièces...</option>
                        <?php foreach ($playsList as $list) { ?>
                            <option value="<?= $list->getId() ?>"
                                <?php if ($editMode && $play == $list) { echo ' selected'; } ?>
                            ><?= $list->getYearTitle() ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <!-- BUDGET -->
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class='input-group d-flex align-items-center'>
                            <label class="form-label text-required" for="budgetStart">Solde Initial&ensp;</label>
                            <input type='number' step='0.01' placeholder='0.00' class="form-control" name="budgetStart" id="budgetStart" value="<?= $budgetStart ?: '0.00' ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-3 mt-lg-0">
                    <div class="form-group">
                        <div class='input-group d-flex align-items-center'>
                            <label class="form-label text-required" for="budgetEnd">Solde Final&ensp;</label>
                            <input type='number' step='0.01' placeholder='0.00' class="form-control" name="budgetEnd" id="budgetEnd" value="<?= $budgetEnd ?: '0.00' ?>" required/>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ACTIVE -->
            <div class="row mt-5">
                <div class="form-group form-check mb-3 ms-3">
                    <label class="py-0 text-muted form-check-label" for="active">Saison active</label>
                    <input type="checkbox" class="form-check-input" name="active" id="active" <?= $active ? 'checked' : '' ?>>
                </div>
            </div>

            <?php if (!empty($createdBy) || (!empty($updatedBy))) { ?>
                <div class="d-flex flex-wrap justify-content-lg-between justify-content-center mt-5">
                    <div class="col-lg-6 col-12">
                        <p class="text-muted">Créé par:&ensp;<?= $createdBy ?></p>
                    </div>
                    <div class="col-lg-6 col-12 text-lg-end mt-3 mt-lg-0">
                        <p class="text-muted">Modifié par:&ensp;<?= $updatedBy ?: ' - ' ?></p>
                    </div>
                </div>
            <?php } ?>

            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

            <hr class="my-3">

            <div class="row">
                <div class="d-flex flex-wrap justify-content-evenly gap-2">
                    <button type="reset" class="btn btn-danger col-md-4 px-3 py-2">Réinitialiser</button>
                    <button type="submit" class="btn btn-primary col-md-4 px-3 py-2">Sauvegarder</button>
                </div>
            </div>
        </form>
    </div>
</div>
