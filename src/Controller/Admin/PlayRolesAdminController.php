<?php
namespace App\Controller\Admin;

use AllowDynamicProperties;
use App\Repository\ActorRepository;
use App\Repository\PlayRepository;
use App\Repository\PlayRolesRepository;
use App\Service\AbstractController;
use App\Service\FileManager;
use App\Service\Session;

#[AllowDynamicProperties] class PlayRolesAdminController extends AbstractController
{
    const CTRL_VIEW = 'admin/playroles/';
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
            'plays' => $this->play->findAllYearDesc(),
            'arrayRoles' => $this->playRoles->arrayAllRolesByPlayDesc(),
            'pageTitle' => 'Liste des Rôles',
        ]);
    }

    public function view(int $id): array
    {
        Session::removeIfNotAdmin();

        return $this->render(self::CTRL_VIEW . "view.php", [
            'play' => $this->play->findOneById($id),
            'playRoles' => $this->playRoles->playRoles_actor_ByPlayId($id),
            'pageTitle' => 'Pièce - Aperçu',

        ]);
    }

    public function delete(int $id): void
    {
        Session::removeIfNotAdmin();

        if ($this->playRoles->findOneById($id)) {
            try {
                $this->playRoles->deleteRecord($id);
                $this->addFlash('success', 'Element supprimé avec success.', 'Suppression');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'Une erreur est survenue. Contactez le WebMaster.', 'Suppression');
            }
        }

        $this->redirectTo('?ctrl=playRolesAdmin&action=index');
    }

    public function form(int $id = null): array
    {
        Session::removeIfNotAdmin();

        $editMode = null;

        $play = null;
        $roleName = null;
        $actor = null;

        //editMode
        if ($id && empty($_POST) && $roles = $this->playRoles->findOneById($id)) {
            $editMode = '&id='.$id;

            $play = $roles->getPlay() ? $roles->getPlay() : null;
            $actor = $roles->getActor() ? $roles->getActor() : null;
            $roleName = $roles->getRoleName() ? $roles->getRoleName() : null;
        }

        if(!empty($_POST))
        {
            $play = filter_input(INPUT_POST, 'play', FILTER_SANITIZE_NUMBER_INT);
            $actor = filter_input(INPUT_POST, 'actor', FILTER_SANITIZE_NUMBER_INT);
            $roleName = htmlspecialchars(filter_input(INPUT_POST, 'roleName'));

            if ($play && $roleName) {
                if (empty($id)) {
                    //save new
                    $this->playRoles->addRecord($play, $actor, $roleName);
                    $this->addFlash("success", "Comédien enregistré !");
                }
                else {
                    //update
                    $this->playRoles->updateData($id, $play, $actor, $roleName);
                    $this->addFlash("success",  "Données modifiées !");
                }
            }
            else {
                $this->addFlash("danger", 'Les champs Pièce et Rôle sont obligatoires');
            }
            $this->redirectTo('?ctrl=playRolesAdmin&action=index');
        }

        return $this->render(self::CTRL_VIEW . "form.php", [
            'play' => $play ?: null,
            'actor' => $actor ?: null,
            'roleName' => $roleName ?: null,
            'playsList' => $this->play->findAllYearDesc(),
            'actorsList' => $this->actor->findAll(),
            'editMode' => $editMode,
            'pageTitle' => $id ? 'Modifier Rôle' : 'Nouveau Rôle',
        ]);
    }

}