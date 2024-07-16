<?php
    use App\Service\Session;
    $isAdmin = (Session::isAdmin());
    $pageTitle = $response['data']['pageTitle'] ?? 'Admin : ' . Session::getUser()->getFirstname();
    $cssFile = $response['data']['cssFile'] ?? null;
?>

<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="Les Agit'acteurs" />
    <meta name="author" content="JDGomes" />
    <title><?= $pageTitle ?></title>
    <title>Les Agit'acteurs</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= ASSETS_PATH . "admin/favicon_admin.ico" ?>" />
    <!-- Font Awesome icons (free version) -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="<?= CSS_PATH . "bs-styles.css" ?>" rel="stylesheet" />
    <link href="<?= CSS_PATH . "admin_style.css" ?>" rel="stylesheet" />

    <?php if (!empty($cssFile)) { ?>
        <link href="<?= CSS_PATH . $cssFile ?>" rel="stylesheet" />
    <?php } ?>

    <!-- TextEditor -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.7.0/tinymce.min.js" integrity="sha512-kGk8SWqEKL++Kd6+uNcBT7B8Lne94LjGEMqPS6rpDpeglJf3xpczBSSCmhSEmXfHTnQ7inRXXxKob4ZuJy3WSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= JS_PATH . "admin-tinymce.js" ?>"></script>

<body id="page-top">

    <?php if ($isAdmin) { ?>

        <?php include VIEW_ADMIN_PATH . "home/components/flash_message.php"; ?>
        <?php include VIEW_ADMIN_PATH . "components/modal_delete.php"; ?>
        <!-- Navigation -->
        <?php include VIEW_ADMIN_PATH . "home/components/navbar.php"; ?>

        <!-- Page Content -->
        <div id="main-container">
            <section class="page-section">
                <?= $content ?>
            </section>
        </div>
    <?php } ?>

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS -->
    <script src="<?= JS_PATH . "admin-script.js" ?>"></script>
</body>
</html> 