<?php
    namespace App\Service;

    abstract class Router
    {
        /**
         * Traite la demande de l'utilisateur et renvoie le résultat d'un controller
         * 
         * @return array - un tableau contenant "view", la vue à afficher et "data", les données nécessaires à la vue
         */
        public static function handleRequest(): array
        {
            $ctrl = DEFAULT_CTRL; //home par défaut
            if (Session::isAdmin()) {
                $ctrl = 'admin'; //admin par défaut
            }
            $action = DEFAULT_ACTION; //action "index" par défaut
            $id = null; //admin : _GET

            //ya t il un param ctrl dans l'URL ? Si y a pas
            if(isset($_GET["ctrl"])){
                $ctrl = $_GET["ctrl"];//on récupère le param ctrl de l'URL
            }

            //depuis ce param, on fabrique le nom officiel du controller voulu
            //"home" => "HomeController"
            $ctrlname = ucfirst($ctrl)."Controller";
            //on fabrique aussi le namespace de la classe Controller à charger
            //"App\Controller\HomeController"
            //FQCN = Fully Qualified Class Name = namespace+nom_classe
            $ctrlFQCN = "App\\Controller\\".$ctrlname;
            if (Session::isAdmin()) {
                $ctrlFQCN = "App\\Controller\\Admin\\".$ctrlname;
            }
            //si le chemin fabriqué ci-dessus ne correspond pas à un fichier existant
            if(!class_exists($ctrlFQCN)) {
                //Error
                $ctrlFQCN = HOME_CTRL;
                $controller = new $ctrlFQCN();
                $action = 'error404';
                header('HTTP/1.0 404 Not Found');
                return $controller->$action();
            }
            else {
                //si un param action est dans l'URL ET si ce param correspond à une méthode du controller
                if (isset($_GET["action"]) && method_exists($ctrlFQCN, $_GET['action'])){
                    //l'action à exécuter est celle de l'URL
                    $action = $_GET['action'];
                    if (isset($_GET["id"]))
                        $id = $_GET["id"];
                } else {
                    //pour éviter une error sur Homepage
                    if (!empty($_GET["action"])) {
                        //Error
                        $ctrlFQCN = HOME_CTRL;
                        $controller = new $ctrlFQCN();
                        $action = 'error404';
                        header('HTTP/1.0 404 Not Found');
                        return $controller->$action();
                    }
                }

            }
            //on instancie le controller voulu => new HomeController()
            $controller = new $ctrlFQCN();
            //la response à traiter sera le retour de l'appel de la méthode du controller
            //$response = HomeController->index()
            return empty($id) ? $controller->$action() : $controller->$action($id);
        }

        public static function redirect($route): void
        {
            header("Location:".$route);
            die;
        }

        public static function generateToken(): string
        {
            $key = bin2hex(random_bytes(32));
            $csrf_token = hash_hmac("sha256", SECRET_APP, $key);
            setcookie("CSRF_KEY", $csrf_token);
            return $csrf_token;
        }

        public static function CSRFProtection(): void
        {
            if(!empty($_POST) && isset($_POST["csrf_token"])){
                if(!hash_equals($_POST["csrf_token"], $_COOKIE["CSRF_KEY"])){
                    session_destroy();
                    session_start();
                    Session::setMessage("danger", "Invalid CSRF token");
                    self::redirect("index.php");
                }
            }
        }

    }