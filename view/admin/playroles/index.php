<?php
    use App\Service\CommonFunctions;

    $plays = $response["data"]["plays"];
    $roles = $response["data"]["arrayRoles"];

?>

<div class="container" id="index-playRoles-form">
    <div class="d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-md-between gap-2">
        <h3 class="text-uppercase text-muted text-center m-0">Liste des Rôles</h3>
        <a class="btn btn-primary px-3 py-2 w-100 w-md-0" href="?ctrl=playRolesAdmin&action=form"><i class="fa-solid fa-square-plus"></i>&ensp;Rôle</a>
    </div>
    <hr class="my-3 p-0">
    <div class="overflow-x-auto">
        <?php if (!empty($plays) && !empty($roles)) {
        foreach ($plays as $play) { ?>
        <div class="row mb-5">
            <div class="col-xl-6 col-lg-9 col-12 mx-auto">
                <h4><?= $play->getYearTitle() ?></h4>
                <table class="table table-striped">
                    <thead class="border-1 text-muted">
                    <tr>
                        <th style="width: 250px;">Rôle</th>
                        <th>Comédien</th>
                        <th style="width: 100px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(array_key_exists($play->getId(), $roles)) {
                        foreach ($roles as $key => $data) {
                            foreach ($data as $role) {
                                if ($key == $play->getId()) { ?>
                                    <tr>
                                        <td><?= $role['role'] ?></td>
                                        <td><?= $role['actor'] ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-dark px-2 py-1" title="Modifier" href="?ctrl=playRolesAdmin&action=form&id=<?= $role['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <button id="del_<?= $role['id'] ?>" name="playRolesAdmin"
                                                    class="btn--delete btn btn-danger px-2 py-1"
                                                    title="Supprimer"
                                                    data-bs-toggle="modal" data-bs-target="#modalDeleteConfirmation"
                                            ><i class="fa-solid fa-trash-can"></i></button>
                                        </td>
                                    </tr>
                    <?php } } } } else { ?>
                    <tr>
                        <td colspan="3" class="text-muted text-center small">Aucun rôle enregistré</td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php } } ?>
    </div>
</div>
