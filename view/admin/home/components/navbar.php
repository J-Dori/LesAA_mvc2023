<?php
use App\Service\CommonFunctions;
use App\Service\Session;
?>

<nav id="mainNav" class="navbar navbar-expand-lg navbar-light fixed-top bg-dark navbar-dark shadow">
    <div class="container-fluid">

        <a class="navbar-brand order-lg-1 order-2 me-lg-5 me-0" href="https://lesagitacteurs.fr" target="_blank" title="Site Web">
            <img src="<?= CommonFunctions::fileExists(LOGO_PATH, "main_logo.png") ?>" alt="Logo" />
        </a>
        <a class="nav-item active me-lg-5 order-lg-2 order-1" aria-current="page" href="/" title="Accueil Administrateur">Accueil</a>
        <button class="navbar-toggler collapsed order-lg-4 order-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-content">
            <div class="hamburger-toggle">
                <i class="fas fa-bars fa-lg"></i>
            </div>
        </button>

        <div class="collapse navbar-collapse order-lg-3 order-4" id="navbar-content">
            <?php if (!empty(Session::isAdmin()) || !empty(Session::isAccount()) ) { ?>
                <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                    <?php if (!empty(Session::isAdmin())) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle me-lg-3" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Pièces</a>
                            <ul class="dropdown-menu shadow">
                                <li><a class="dropdown-item" href="?ctrl=playAdmin&action=index">Pièces</a></li>
                                <li><a class="dropdown-item" href="?ctrl=actorAdmin&action=index">Comédiens</a></li>
                                <li><a class="dropdown-item" href="?ctrl=playRolesAdmin&action=index">Rôles</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle me-lg-3" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Contacts</a>
                            <ul class="dropdown-menu shadow">
                                <li><a class="dropdown-item" href="?ctrl=contactAdmin&action=index">Contacts</a></li>
                                <li><a class="dropdown-item" href="?ctrl=socialMediaAdmin&action=index">Réseaux Sociaux</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle me-lg-3" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Général</a>
                            <ul class="dropdown-menu shadow">
                                <li><a class="dropdown-item" href="?ctrl=headersAdmin&action=index">En-têtes</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="?ctrl=blogAdmin&action=index">Articles</a></li>
                                <li><a class="dropdown-item" href="?ctrl=teamAdmin&action=index">Membres</a></li>
                                <li><a class="dropdown-item" href="?ctrl=aboutAdmin&action=index">Parcours</a></li>
                                <li><a class="dropdown-item" href="?ctrl=partnersAdmin&action=index">Partenaires</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="?ctrl=userAdmin&action=index">Utilisateurs</a></li>
                            </ul>
                        </li>
                    <?php } ?>

                    <li class="nav-item">
                        <a class="nav-link" href="?ctrl=finSeasonAdmin&action=index">Trésorerie</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link text-uppercase dropdown-toggle me-lg-5" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside"><?= Session::getUser()->getUserAndIcon() ?></a>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item" href="?ctrl=userAdmin&action=update&id=<?= Session::getUser()->getId() ?>"><i class="fa-solid fa-pen-to-square"></i>&ensp;Données</a></li>
                            <li><a class="dropdown-item" href="?ctrl=userAdmin&action=formUpdatePassword"><i class="fa-solid fa-key"></i>&ensp;Mot de Passe</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="?ctrl=admin&action=logout"><i class="fa-solid fa-right-from-bracket text-danger"></i>&ensp;Déconnecter</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?ctrl=admin&action=logout" title="Déconnecter"><i class="fa-solid fa-right-from-bracket text-danger"></i></a>
                    </li>
                </ul>
            <?php } ?>
        </div>
    </div>
</nav>
