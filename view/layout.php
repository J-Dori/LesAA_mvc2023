<?php $cssFile = $response['data']['cssFile'] ?? null; ?>

<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="robots" content="index, follow">
    <meta name="description" content="Les Agit'acteurs - La troupe de théâtre des jeunes à Wisches - Hersbach (67)" />
    <meta name="author" content="JDGomes" />
    <title>Les Agit'acteurs</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= ASSETS_PATH . "favicon.ico" ?>" />
    <!-- Font Awesome icons (free version) -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="<?= CSS_PATH . "bs-styles.css" ?>" rel="stylesheet" />
    <link href="<?= CSS_PATH . "style.css" ?>" rel="stylesheet" />
    <?php if (!empty($cssFile)) { ?>
        <link href="<?= CSS_PATH . $cssFile ?>" rel="stylesheet" />
    <?php } ?>
</head>
<body id="page-top">

    <!-- Image Modal -->
    <?php include VIEW_PATH . "home/components/image_modal.php"; ?>

    <!-- Navigation -->
    <?php include VIEW_PATH . "home/components/navbar.php"; ?>

    <!-- Banner -->
    <?php include VIEW_PATH . "home/components/banner.php"; ?>

    <!-- Page Content -->
    <?= $content ?>

    <!-- Footer -->
    <?php include VIEW_PATH . "home/components/footer.php"; ?>

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS -->
    <script src="<?= JS_PATH . "navbar.js" ?>"></script>
    <script src="<?= JS_PATH . "image_modal.js" ?>"></script>

</body>
</html> 