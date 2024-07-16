<?php
namespace App\Controller\Admin;

use AllowDynamicProperties;
use App\Repository\UserRepository;
use App\Service\AbstractController;
use App\Service\Session;

#[AllowDynamicProperties] class UserAdminController extends AbstractController
{
    const CTRL_VIEW = 'admin/user/';
    public function __construct()
    {
        $this->user = new UserRepository();
    }
    
    public function index(): array
    {
        Session::removeIfNotAdmin();

        return $this->render(self::CTRL_VIEW . "index.php", [
            'users' => $this->user->findAll(),
            'pageTitle' => 'Liste des Utilisateurs',
        ]);
    }

    public function delete(int $id): void
    {
        Session::removeIfNotAdmin();

        if ($partner = $this->user->findOneById($id)) {
            try {
                $this->user->deleteUser($id);
                $message = 'Utilisateur supprimé';
                $this->addFlash('success', $message.' avec success.', 'Suppression');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'Une erreur est survenue. Contactez le WebMaster.', 'Suppression');
            }
        }

        $this->redirectTo('?ctrl=userAdmin&action=index');
    }

    public function register()
    {
        Session::removeIfNotAdmin();

        if(!empty($_POST)){
            $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
            $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_SPECIAL_CHARS);
            $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_SPECIAL_CHARS);
            $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_NUMBER_INT);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!?\#\$%&*-+\.\/_])[a-zA-Z0-9!?\#\$%&*-+\.\/_]{8,25}$#"
                ]
            ]);

            $password_r = filter_input(INPUT_POST, "password_repeat", FILTER_DEFAULT);

            if ($role == 1) {
                $role = ROLE_ADMIN;
            }
            elseif ($role == 2) {
                $role = ROLE_ACCOUNT;
            } else {
                $role = 'ROLE_USER';
            }

            if ($firstname && $lastname && $role && $email && $password && $password_r)
            {
                if ($password === $password_r)
                {
                    if (!$this->user->verifyUser($email))
                    {
                        $hash = password_hash($password, PASSWORD_BCRYPT);
                        if ($this->user->insertUser(ucfirst($firstname), mb_strtoupper($lastname), $phone, $role, $email, $hash)){
                            $this->addFlash("success", "Utilisateur ". ucfirst($firstname) ." enregistré");
                            $this->redirectTo('?ctrl=userAdmin&action=index');
                        }
                        else $this->addFlash("danger", "Erreur 500, veuillez réessayer plus tard !");
                    }
                    else $this->addFlash("danger", "Cet e-mail est déjà utilisé !<br>Veuillez en choisir un autre...");
                }
                else $this->addFlash("danger", "Les mots de passe ne correspondent pas !");
            }
            else $this->addFlash("danger", "Tous les champs, except le nº téléphone, sont requis");
        }
        return $this->render(self::CTRL_VIEW . "form/new.php",[
            'pageTitle' => 'Formulaire Utilisateurs'
        ]);
    }

    public function update(int $id): ?array
    {
        $currentUserInSession = Session::getUser();
        $currentEmailInSession = Session::getUser()->getEmail();
        $user = $this->user->findOneById($id);
        $role = null;

        if(empty($_POST && $user)) {
            if (empty($user)) {
                $this->addFlash("danger", "L'utilisateur sélectionné inexistant en base de données");
                $this->redirectTo('?ctrl=userAdmin&action=index');
            } else {
                if ($user->getRole() == ROLE_ADMIN)
                {
                    $role = 1;
                } elseif ($user->getRole() == ROLE_ACCOUNT) {
                    $role = 2;
                } else {
                    $role = 3;
                }
            }
        }

        if(!empty($_POST))
        {
            $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
            $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_SPECIAL_CHARS);
            $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_SPECIAL_CHARS);
            $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_NUMBER_INT);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

            if ($currentUserInSession == $user) {
                $role = $user->getRole();
            }
            else {
                if ($role == 1)
                {
                    $role = ROLE_ADMIN;
                } elseif ($role == 2) {
                    $role = ROLE_ACCOUNT;
                } else {
                    $role = 'ROLE_USER';
                }
            }

            if ($firstname && $lastname && $role && $email)
            {
                if ($this->user->updateUser($id, $firstname, $lastname, $phone, $role, $email)) {
                    if ($currentUserInSession == $user && $currentEmailInSession !== $email) {
                        // If current user changes email address, he/she has to log in again
                        unset($_SESSION["user"]);
                        $this->redirectTo('?ctrl=security&action=login');
                    } else {
                        $this->addFlash("success", "Modification des données enregistrées.");
                        $this->redirectTo('?ctrl=userAdmin&action=index');
                    }
                }
                else {
                    $this->addFlash("danger", "Une erreur est survenue.<br>Les données n'ont pas été enregistrées.");
                }
            }
            else {
                $this->addFlash("danger", "Tous les champs, except le nº téléphone, sont requis");
            }
        }

        return $this->render(self::CTRL_VIEW . "form/update.php",[
            'id' => $user->getId() ?: '',
            'firstname' => $user->getFirstname() ?: '',
            'lastname' => $user->getLastname() ?: '',
            'phone' => $user->getPhone() ?: '',
            'email' => $user->getEmail() ?: '',
            'role' => $role,
            'pageTitle' => 'Formulaire Utilisateurs'
        ]);
    }

    public function formUpdatePassword(): array
    {
        return $this->render(self::CTRL_VIEW . "form/updatePassword.php");
    }

    public function updatePassword(int $id): void
    {
        $thisUser = Session::getUser();

        if ($thisUser->getId() == $id) {
            if (!empty($_POST)) {
                $currentPassword = filter_input(INPUT_POST, "current_password", FILTER_DEFAULT);
                //symbols auth = ! ? # $ % & * - + .
                $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                    "options" => [
                        "regexp" => "#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!?\#\$%&*-+])[a-zA-Z0-9!?\#\$%&*-+]{8,25}$#"
                    ]
                ]);
                $passwordRepeat = filter_input(INPUT_POST, "password_repeat", FILTER_DEFAULT);

                if ($currentPassword && $password && $passwordRepeat) {
                    $email = Session::getUser()->getEmail();
                    if ($email) {
                        if ($thisUser) {
                            $oldPassword = $this->user->findPasswordByEmail($email);
                            if (password_verify($currentPassword, $oldPassword)) {
                                if ($password !== $passwordRepeat) {
                                    //JS disables submit button if passwords are different
                                    $this->addFlash("danger", "Les champs <b>Nouveau Mot de Passe</b> et <b>Répétez le Mot de Passe</b><br>doivent être identiques. Veuillez réessayer!...");
                                }
                                else {
                                    //upd password
                                    $hash = password_hash($password, PASSWORD_BCRYPT);
                                    $this->user->updatePassword($email, $hash);
                                    $this->addFlash("success", "Le mot de passe a été modifié avec succès !<br>Veuillez vous reconnecter...");
                                    unset($_SESSION["user"]);
                                    $this->redirectTo("ctrl=security&action=login");
                                }
                            }
                            else {
                                $this->addFlash("danger", "Votre <b>mot de passe actuel</b> n'est pas correct.<br>Veuillez réessayer!");
                            }
                        }
                    }
                }
                else {
                    $this->addFlash("danger", "Tous les champs sont requis");
                }
                $this->redirectTo("?ctrl=userAdmin&action=formUpdatePassword");
            }
        }
        $this->addFlash("danger", "Seul l'utilisateur propriétaire du compte peut changer son mot de passe");
        $this->redirectTo("?ctrl=admin&action=index");
    }
}
