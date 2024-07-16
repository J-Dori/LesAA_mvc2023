<?php
    $categories = $response["data"]["categories"];
?>

<div class="container" id="admin-fin-manager-index">
    <div class="d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-md-between gap-2">
        <div>
            <h3 class="text-uppercase text-muted text-center m-0">Trésorerie : Catégories</h3>
        </div>
        <div>
            <a class="btn btn-primary px-3 py-2 w-100 w-md-0" href="?ctrl=finCategoryAdmin&action=form"><i class="fa-solid fa-square-plus"></i>&ensp;Catégorie</a>
            <a class="btn btn-secondary px-3 py-2 w-100 w-md-0 mt-3 mt-md-0" href="?ctrl=finSeasonAdmin&action=index"><i class="fa-solid fa-folder-open"></i>&ensp;Saisons</a>
        </div>
    </div>
    <hr class="my-3 p-0">
    <div class="overflow-x-auto">
        <?php if (isset($categories) && !empty($categories)) { ?>
            <table class="table table-striped">
                <thead class="border-1 text-muted">
                <tr>
                    <th>Titre</th>
                    <th style="width: 100px;"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($categories as $category) { ?>
                <tr>
                    <td><?= $category->getTitle() ?></td>
                    <td class="text-center">
                        <a class="btn btn-dark px-2 py-1" title="Modifier" href="?ctrl=finCategoryAdmin&action=form&id=<?= $category->getId() ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        <button id="del_<?= $category->getId() ?>" name="finCategoryAdmin"
                                class="btn--delete btn btn-danger px-2 py-1"
                                title="Supprimer"
                                data-bs-toggle="modal" data-bs-target="#modalDeleteConfirmation"
                        ><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                <?php } ?>
                </tr>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>
