<?php
    use App\Service\Session;

    $users = $response["data"]["users"];
?>

<div class="container" id="admin-user-index">
    <div class="d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-md-between gap-2">
        <h3 class="text-uppercase text-muted text-center m-0">Utilisateurs</h3>
        <a class="btn btn-primary px-3 py-2 w-100 w-md-0" href="?ctrl=userAdmin&action=register"><i class="fa-solid fa-square-plus"></i>&ensp;Utilisateur</a>
    </div>
    <hr class="my-3 p-0">
    <div class="overflow-x-auto">
        <?php if (isset($users) && !empty($users)) { ?>
            <table class="table table-striped">
                <thead class="border-1 text-muted">
                <tr>
                    <th>Rôle</th>
                    <th>NOM</th>
                    <th>E-mail</th>
                    <th>Nº Téléphone</th>
                    <th style="width: 100px;"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user) {
                    // Do not display $currentUser in list
                    if ($user->getId() !== Session::getUser()->getId()) { ?>
                <tr>
                    <td><?= $user->getRoleTypeAndIcon(); ?></td>
                    <td><?= $user->FullName() ?></td>
                    <td><a class="text-primary" href="mailto:<?= $user->getEmail() ?>"><?= $user->getEmail() ?></a></td>
                    <td><a class="text-primary" href="tel:<?= $user->getPhoneLink() ?>"><?= $user->getPhone() ?></a></td>
                    <?php if (Session::isAdmin()) { ?>
                        <td class="text-center">
                            <a class="btn btn-dark px-2 py-1" title="Modifier" href="?ctrl=userAdmin&action=update&id=<?= $user->getId() ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            <button id="del_<?= $user->getId() ?>" name="userAdmin"
                                    class="btn--delete btn btn-danger px-2 py-1"
                                    title="Supprimer"
                                    data-bs-toggle="modal" data-bs-target="#modalDeleteConfirmation"
                            ><i class="fa-solid fa-trash-can"></i></button>
                        </td>
                    <?php } ?>
                <?php } } ?>
                </tr>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>
