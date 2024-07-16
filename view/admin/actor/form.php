<?php
    use App\Repository\PlayRepository;
    $playRepo = new PlayRepository();

    $editMode = $response["data"]["editMode"] ?? null;
    $playParticipation = $response["data"]["playParticipation"] ?? null;

    $actor = $response["data"]["actor"] ?? null;

    $firstname = $response["data"]["firstname"] ?? null;
    $lastname = $response["data"]["lastname"] ?? null;
    $email = $response["data"]["email"] ?? null;
    $phone = $response["data"]["phone"] ?? null;
?>

<div class="container" id="admin-actor-form">
    <div class="text-center">
        <h3 class="text-uppercase text-muted">Formulaire Comédiens</h3>
        <p class="mb-0"><small class="text-danger "><strong>Champs obligatoires :</strong></small></p>
        <p><small class="text-muted">Prénom</small></p>
    </div>
    <div class="row gap-2">

        <div class="col-lg-5 col-12 mx-auto p-lg-5 p-3 border-light shadow">
            <form action="?ctrl=actorAdmin&action=form<?= $editMode ?>" method="POST">
                <!-- FIRSTNAME / LASTNAME -->
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label text-required" for="firstname">Prénom</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" maxlength="50"  value="<?= $firstname ?>" placeholder="Prénom" required>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label text-muted" for="lastname">NOM</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" maxlength="50"  value="<?= $lastname ?>" placeholder="NOM">
                    </div>
                </div>

                <!-- EMAIL -->
                <div class="row">
                    <div class="form-group mb-3">
                        <label class="form-label text-muted" for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" maxlength="255"  value="<?= $email ?>" placeholder="E-mail">
                    </div>
                </div>

                <!-- PHONE -->
                <div class="row">
                    <div class="form-group">
                        <label class="form-label text-muted" for="phone">Nº Téléphone</label>
                        <input type="tel" class="form-control" name="phone" id="phone" pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" value="<?= $phone ?>" placeholder="ex: 06 00 00 00 00">
                        <small id="phonePattern" class="text-muted">Respectez le format : 06 00 00 00 00</small>
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

        <div class="col-lg-5 col-12 mx-auto p-lg-5 p-3 border-light shadow">
            <table class="table">
                <thead class="border-1 text-muted">
                <tr>
                    <th>Pièce</th>
                    <th>Rôle</th>
                </tr>
                </thead>

                <?php
                if (!empty($playParticipation)) {
                    echo '<tbody>';
                    foreach ($playParticipation as $participation) {
                        $play = $playRepo->findOneById($participation->getPlay());
                    ?>
                        <tr>
                            <td><?= $play->getYearTitle() ?></td>
                            <td><?= $participation->getRoleName() ?></td>
                        </tr>
                        </tbody>
                    <?php }
                    echo '</tdoby>';
                } else { ?>
                    <tbody>
                    <tr>
                        <td colspan="2" class="text-muted text-center small">Aucune participation</td>
                    </tr>
                    </tbody>
                <?php } ?>
            </table>
        </div>

    </div>
</div>
