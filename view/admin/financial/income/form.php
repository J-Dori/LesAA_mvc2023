<?php
    use App\Repository\FinCategoryRepository;
    $categoryRepo = new FinCategoryRepository();
    $categories = $categoryRepo->findAll();

    $editMode = $response["data"]["editMode"] ?? null;

    $season = $response["data"]["season"] ?? null;

    $finCategory = $response["data"]["finCategory"] ?? null;
    $finNumber = $response["data"]["finNumber"] ?? null;
    $date = $response["data"]["date"] ?? null;
    $description = $response["data"]["description"] ?? null;
    $amount = $response["data"]["amount"] ?? null;
    $mop = $response["data"]["mop"] ?? null;
    $docRef = $response["data"]["docRef"] ?? null;
    $createdBy = $response["data"]["createdBy"] ?? null;
    $createdAt = $response["data"]["createdAt"] ?? null;
    $updatedBy = $response["data"]["updatedBy"] ?? null;
    $updatedAt = $response["data"]["updatedAt"] ?? null;
?>

<div class="container" id="admin-fin-income-form">
    <div class="text-center mb-3">
        <h3 class="text-uppercase text-success">Formulaire Revenus</h3>
        <p class="mb-0"><small class="text-danger "><strong>Champs obligatoires :</strong></small></p>
        <p><small class="text-muted">Revenu nº, Date, Catégorie, MP et Montant </small></p>
    </div>

    <div class="col-lg-8 col-12 mx-auto p-lg-5 p-3 border-light shadow">
        <form action="?ctrl=finIncomeAdmin&action=form<?= $editMode ?>" method="POST" enctype="multipart/form-data">
            <!-- SEASON INFO -->
            <div class="row">
                <h4>Saison <?= $season->getYear() ?? '' ?></h4>
                <p class="text-muted"><?= $season->getPlay() ? $season->getPlayTitle() : '' ?></p>
                <hr class="mt-3">
            </div>

            <!-- FIN NUMBER / DATE -->
            <div class="row justify-content-between">
                <div class="col-lg-4 form-group mb-3">
                    <label class="form-label text-required" for="finNumber">Revenu nº</label>
                    <input type="number" class="form-control" name="finNumber" maxlength="4"  id="finNumber" value="<?= $finNumber ?>" required>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label text-required" for="date">Date</label>
                        <input type='date' class="form-control" name="date" id="date" value="<?= $date ?>" required/>
                    </div>
                </div>
            </div>

            <!-- CATEGORY -->
            <div class="row">
                <div class="col">
                    <label class="form-label form-label text-required" for="finCategory">Catégorie</label>
                    <select class="form-select" id="finCategory" name="finCategory" required>
                        <option <?= empty($editMode) ?? 'selected' ?>>Liste de Catégories...</option>
                        <?php foreach ($categories as $category) { ?>
                            <option value="<?= $category->getId() ?>"
                                <?php if ($editMode && $finCategory == $category) { echo ' selected'; } ?>
                            ><?= $category->getTitle() ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <!-- DESCRIPTION -->
            <div class="row">
                <div class="col-12 form-group">
                    <label class="form-label text-muted" for="description">Description</label>
                    <small class="ps-3 text-muted form-char-length">1500 caractères</small>
                    <textarea class="textareaEditorBoldAndItalic" name="description" id="description"><?= $description ?></textarea>
                </div>

            </div>

            <!-- MOP / AMOUNT -->
            <div class="row my-5">
                <div class="col-12 col-lg-4">
                    <label class="form-label form-label text-required" for="mop">Mode Paiement</label>
                    <select class="form-select" id="mop" name="mop" required>
                        <option <?= empty($editMode) ?? 'selected' ?>>--- Mode Paiement ---</option>
                        <option value="Chèque" <?php if ($editMode && $mop == 'Chèque') { echo ' selected'; } ?>>Chèque</option>
                        <option value="CB" <?php if ($editMode && $mop == 'CB') { echo ' selected'; } ?>>CB</option>
                        <option value="Espèce" <?php if ($editMode && $mop == 'Espèce') { echo ' selected'; } ?>>Espèce</option>
                        <option value="Virement" <?php if ($editMode && $mop == 'Virement') { echo ' selected'; } ?>>Virement</option>
                    </select>
                </div>
                <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                    <div class="form-group">
                        <label class="form-label text-required" for="amount">Montant</label>
                        <input type='number' step='0.01' placeholder='0.00' class="form-control" name="amount" id="amount" value="<?= $amount ?: '0.00' ?>" required/>
                    </div>
                </div>
                <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                    <div class="form-group">
                        <label class="form-label text-muted" for="docRef">Doc/Ref</label>
                        <input type='text' placeholder='Doc/Ref Paiement' class="form-control" name="docRef" id="docRef" value="<?= $docRef ?: '' ?>"/>
                    </div>
                </div>
            </div>

            <?php if (!empty($createdBy) || (!empty($updatedBy))) { ?>
                <div class="d-flex flex-wrap justify-content-lg-between justify-content-center mb-3" style="font-size: 10px">
                    <div class="col-lg-6 col-12">
                        <p class="text-muted">Créé par:&ensp;<?= $createdBy ?></p>
                        <p class="text-muted">Le:&ensp;<?= $createdAt ?></p>
                    </div>
                    <div class="col-lg-6 col-12 text-lg-end mt-3 mt-lg-0">
                        <?php if (!empty($updatedBy)) { ?>
                            <p class="text-muted">Modifié par:&ensp;<?= $updatedBy ?: ' - ' ?></p>
                            <p class="text-muted">Le:&ensp;<?= $updatedAt ?: ' - ' ?></p>
                        <?php } ?>
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
