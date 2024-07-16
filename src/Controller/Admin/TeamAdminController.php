<?php
namespace App\Controller\Admin;

use AllowDynamicProperties;
use App\Repository\TeamRepository;
use App\Service\AbstractController;
use App\Service\FileManager;
use App\Service\Session;

#[AllowDynamicProperties] class TeamAdminController extends AbstractController
{
    const CTRL_VIEW = 'admin/team/';
    public function __construct()
    {
        $this->team = new TeamRepository();
    }
    
    public function index(): array
    {
        Session::removeIfNotAdmin();

        return $this->render(self::CTRL_VIEW . "index.php", [
            'team' => $this->team->teamByRoleOrder(),
            'pageTitle' => 'Liste des Membres',
        ]);
    }

    public function delete(int $id): void
    {
        Session::removeIfNotAdmin();

        if ($partner = $this->team->findOneById($id)) {
            try {
                $this->team->deleteRecord($id);
                $message = 'Element supprimé';
                if (file_exists(IMG_TEAM . $partner->getImgPath())) {
                    unlink(IMG_TEAM . $partner->getImgPath());
                    $message = 'Element et image supprimés';
                }
                $this->addFlash('success', $message.' avec success.', 'Suppression');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'Une erreur est survenue. Contactez le WebMaster.', 'Suppression');
            }
        }

        $this->redirectTo('?ctrl=teamAdmin&action=index');
    }

    public function form(int $id = null): array
    {
        Session::removeIfNotAdmin();

        $editMode = null;
        $fileUploadErrorMessage = null;

        $roleOrder = null;
        $name = null;
        $role = null;
        $description = null;
        $imgPath = null;

        //editMode
        if ($id && empty($_POST) && $team = $this->team->findOneById($id)) {
            $editMode = '&id='.$id;

            $roleOrder = $team->getRoleOrder() ? $team->getRoleOrder() : null;
            $name = $team->getName() ? $team->getName() : null;
            $role = $team->getRole() ? $team->getRole() : null;
            $description = $team->getDescription() ? $team->getDescription() : null;
            $imgPath = $team->getImgPath() ? $team->getImgPath() : null;
        }

        if(!empty($_POST))
        {
            $roleOrder = filter_input(INPUT_POST, 'roleOrder', FILTER_SANITIZE_NUMBER_INT);
            $name = htmlspecialchars(filter_input(INPUT_POST, 'name'));
            $role = htmlspecialchars(filter_input(INPUT_POST, 'role'));
            $description = htmlspecialchars_decode(filter_input(INPUT_POST, 'description'));
            $imgPath = filter_input(INPUT_POST, 'fileToUpload');


            if ($name && $role && $roleOrder) {
                if (empty($id)) {
                    //save new
                    $currentId = $this->team->addRecord($name, $role, $roleOrder, $description);

                    if (isset($_FILES)) {
                        $fileUploadErrorMessage = FileManager::uploadFile('team', $currentId, IMG_TEAM);
                    }
                    $this->addFlash("success", "Partenaire enregistré !" . $fileUploadErrorMessage, $name);
                }
                else {
                    //update
                    $currentId = $id;
                    $this->team->updateData($id, $name, $role, $roleOrder, $description);

                    if (isset($_FILES)) {
                        $fileUploadErrorMessage = FileManager::uploadFile('team', $currentId, IMG_TEAM);
                    }
                    $this->addFlash("success",  "Données modifiées !" . $fileUploadErrorMessage, $name);
                }
            }
            else {
                $this->addFlash("danger", 'Les champs Ordre, Nom et Rôle sont obligatoires');
            }
            $this->redirectTo('?ctrl=teamAdmin&action=index');
        }

        return $this->render(self::CTRL_VIEW . "form.php", [
            'roleOrder' => $roleOrder ?: null,
            'name' => $name ?: null,
            'role' => $role ?: null,
            'description' => $description ?: null,
            'imgPath' => $imgPath ?: null,
            'editMode' => $editMode,
            'pageTitle' => $id ? 'Modifier Membre' : 'Nouveau Membre',
        ]);
    }
}
