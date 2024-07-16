<?php

use App\Service\CommonFunctions;

$navBarLogoUrl = isset($_GET['ctrl']);
?>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="<?= $navBarLogoUrl ? '/' : '#page-top' ?>"><img src="<?= CommonFunctions::fileExists(LOGO_PATH, "main_logo.png") ?>" alt="Logo" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="?ctrl=home&action=playIndex">Pièces</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= !$navBarLogoUrl ? '/#about' : '?ctrl=home&action=index#about' ?>">Parcours</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= !$navBarLogoUrl ? '/#team' : '?ctrl=home&action=index#team' ?>">Équipe</a></li>
                <li class="nav-item"><a class="nav-link" href="?ctrl=home&action=blogIndex">Actualités</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= !$navBarLogoUrl ? '#contact' : '?ctrl=home&action=index#contact' ?>">Contacts</a></li>
            </ul>
        </div>
    </div>
</nav>
