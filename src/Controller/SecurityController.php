<?php
namespace App\Controller;

use AllowDynamicProperties;
use App\Service\AbstractController;
use App\Service\Session;
use App\Repository\UserRepository;


#[AllowDynamicProperties] class SecurityController extends AbstractController
{

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->session = new Session();
    }
 
    public function index(): array
    {
        return $this->render("security/login.php", ['noFooter' => true]);
    }

    /**
     * Checking if user is ADMIN beforehand in every method.
     * If not, the current user will be immediately LoggedOut.
     */
    public function isAdmin()
    {
        if (Session::getUser()->getRole() !== ROLE_ADMIN || Session::getUser()->getRole() !== ROLE_ACCOUNT) {
            $this->logoutUser();
        }
        return;
    }

//***************************** LOGIN / REGISTER / LOGOUT ****************************/
    public function login(): array
    {
        if(!empty($_POST)){
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!?\#\$%&*-+\.\/_])[a-zA-Z0-9!?\#\$%&*-+\.\/_]{8,25}$#"
                    //min - 8 chars
                ]
            ]);

            if($email) {
                $user = $this->userRepository->findUserByEmail($email);

                if($user && $password) {
                    if (password_verify ($password, 
                            $this->userRepository->findPasswordByEmail($email)
                        ))
                    {
                        Session::setUser($user);
                        $this->addFlash("success", "Bienvenue <b>". $user->getFirstname()."</b> !");
                        $this->redirectTo("index.php");
                    }
                    else $this->addFlash("danger", "Votre e-mail ou votre mot de passe sont incorrects");
                }
                else $this->addFlash("danger", "Votre e-mail ou votre mot de passe sont incorrects");
            }
            else
                $this->addFlash("danger", "Tous les champs sont requis");
        }
        return $this->render("security/login.php", ['navActive' => null]); 
    }

    /* Method transferred to Admin/AdminController because Router.php checks if isAdmin() and changes the FQCN
    public function logout()
    {
        $name = Session::getUser() ? Session::getUser()->getFirstname() : "";
        $this->logoutUser(true);
        $this->addFlash("success", "Vous avez été déconnecté !<br>A bientôt <b>$name</b>...");
        $this->redirectTo('index.php');
    }
    */

}