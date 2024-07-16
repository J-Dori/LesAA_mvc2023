<?php
namespace App\Controller\Admin;

use AllowDynamicProperties;
use App\Entity\Actor;
use App\Repository\ActorRepository;
use App\Repository\PlayRepository;
use App\Repository\PlayRolesRepository;
use App\Service\AbstractController;
use App\Service\FileManager;
use App\Service\Session;

#[AllowDynamicProperties] class ActorAdminController extends AbstractController
{
    const CTRL_VIEW = 'admin/actor/';
    public function __construct()
    {
        $this->actor = new ActorRepository();
        $this->play = new PlayRepository();
        $this->playRoles = new PlayRolesRepository();
    }
    
    public function index(): array
    {
        Session::removeIfNotAdmin();

        return $this->render(self::CTRL_VIEW . "index.php", [
            'actors' => $this->actor->findAll(),
            'pageTitle' => 'Liste des Comédiens',
        ]);
    }

    public function delete(int $id): void
    {
        Session::removeIfNotAdmin();

        if ($this->actor->findOneById($id)) {
            try {
                $this->actor->deleteRecord($id);
                $this->addFlash('success', 'Element supprimé avec success.', 'Suppression');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'Une erreur est survenue. Contactez le WebMaster.', 'Suppression');
            }
        }

        $this->redirectTo('?ctrl=actorAdmin&action=index');
    }

    public function form(int $id = null): array
    {
        Session::removeIfNotAdmin();

        $editMode = null;

        $firstname = null;
        $lastname = null;
        $email = null;
        $phone = null;

        //editMode
        if ($id && empty($_POST) && $actor = $this->actor->findOneById($id)) {
            $editMode = '&id='.$id;

            $firstname = $actor->getFirstname() ? $actor->getFirstname() : null;
            $lastname = $actor->getLastname() ? $actor->getLastname() : null;
            $email = $actor->getEmail() ? $actor->getEmail() : null;
            $phone = $actor->getPhone() ? $actor->getPhone() : null;
        }

        if(!empty($_POST))
        {
            $firstname = htmlspecialchars(filter_input(INPUT_POST, 'firstname'));
            $lastname = htmlspecialchars(filter_input(INPUT_POST, 'lastname'));
            $email = htmlspecialchars(filter_input(INPUT_POST, 'email'));
            $phone = htmlspecialchars(filter_input(INPUT_POST, 'phone'));

            if ($firstname) {
                if (empty($id)) {
                    //save new
                    $this->actor->addRecord($firstname, $lastname, $email, $phone);
                    $this->addFlash("success", "Comédien enregistré !");
                }
                else {
                    //update
                    $this->actor->updateData($id, $firstname, $lastname, $email, $phone);
                    $this->addFlash("success",  "Données modifiées !");
                }
            }
            else {
                $this->addFlash("danger", 'Le champ Prénom est obligatoire');
            }
            $this->redirectTo('?ctrl=actorAdmin&action=index');
        }

        return $this->render(self::CTRL_VIEW . "form.php", [
            'firstname' => $firstname ?: null,
            'lastname' => $lastname ?: null,
            'email' => $email ?: null,
            'phone' => $phone ?: null,
            'actor' => !empty($editMode) ? new Actor($this->actor->findOneById($id)) : null,
            'playParticipation' => !empty($editMode) ? $this->playRoles->playRoles_ByActor($id) : null,
            'editMode' => $editMode,
            'pageTitle' => $id ? 'Modifier Comédien' : 'Nouveau Comédien',
        ]);
    }

}