<?php
    $editMode = $response["data"]["editMode"] ?? null;
    $title = $response["data"]["title"] ?? null;
?>

<div class="container" id="admin-fin-category-form">
    <div class="text-center mb-3">
        <h3 class="text-uppercase text-muted">Formulaire Catégories</h3>
        <p class="mb-0"><small class="text-danger "><strong>Champ obligatoire :</strong></small></p>
        <p><small class="text-muted">Titre</small></p>
    </div>

    <div class="col-lg-6 col-12 mx-auto p-lg-5 p-3 border-light shadow">
        <form action="?ctrl=finCategoryAdmin&action=form<?= $editMode ?>" method="POST" enctype="multipart/form-data">
            <!-- TITLE -->
            <div class="row">
                <div class="form-group mb-3">
                    <label class="form-label text-required" for="title">Titre (150)</label>
                    <input type="text" class="form-control" name="title" maxlength="150"  id="title" value="<?= $title ?>" placeholder="ex: Alimentation" required>
                </div>
            </div>

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
