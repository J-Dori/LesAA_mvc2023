<?php
    require "vendor/autoload.php";//fichier activant l'autoload de Composer
    require "config.php";//contient les valeurs par défaut de l'application
    session_start();

    use App\Service\Router;
    use App\Service\Session;

    $response = Router::handleRequest();

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        echo $response; //soit une valeur, soit une page rendue coté serveur (SSR)
    }
    else {
        $csrf_token = Router::generateToken();
        Router::CSRFProtection();
        ob_start();
        //on inclut le fichier vu transmis par le controller en allant dans
        //le chemin des vues par défaut

        //if (Session::isAdmin()) {
        //    include(VIEW_ADMIN_PATH.$response["view"]);
        //} else {
            include(VIEW_PATH.$response["view"]);
        //}
        $content = ob_get_contents();
        ob_end_clean();
        if (Session::isAdmin()) {
            require("view/admin/layout.php");
        } else {
            require("view/layout.php");
        }
    }