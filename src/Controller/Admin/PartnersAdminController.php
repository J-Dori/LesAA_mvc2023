<?php
namespace App\Controller\Admin;

use AllowDynamicProperties;
use App\Repository\PartnersRepository;
use App\Service\AbstractController;
use App\Service\FileManager;
use App\Service\Session;

#[AllowDynamicProperties] class PartnersAdminController extends AbstractController
{
    const CTRL_VIEW = 'admin/partners/';
    public function __construct()
    {
        $this->partners = new PartnersRepository();
    }
    
    public function index(): array
    {
        Session::removeIfNotAdmin();

        return $this->render(self::CTRL_VIEW . "index.php", [
            'partners' => $this->partners->findAll(),
            'pageTitle' => 'Liste des Partenaires',
        ]);
    }

    public function delete(int $id): void
    {
        Session::removeIfNotAdmin();

        if ($partner = $this->partners->findOneById($id)) {
            try {
                $this->partners->deleteRecord($id);
                $message = 'Element supprimé';
                if (file_exists(LOGO_PATH . $partner->getImgPath())) {
                    unlink(LOGO_PATH . $partner->getImgPath());
                    $message = 'Element et image supprimés';
                }
                $this->addFlash('success', $message.' avec success.', 'Suppression');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'Une erreur est survenue. Contactez le WebMaster.', 'Suppression');
            }
        }

        $this->redirectTo('?ctrl=partnersAdmin&action=index');
    }

    public function form(int $id = null): array
    {
        Session::removeIfNotAdmin();

        $editMode = null;
        $fileUploadErrorMessage = null;

        $name = null;
        $imgPath = null;

        //editMode
        if ($id && empty($_POST) && $partners = $this->partners->findOneById($id)) {
            $editMode = '&id='.$id;

            $name = $partners->getName() ? $partners->getName() : null;
            $imgPath = $partners->getImgPath() ? $partners->getImgPath() : null;
        }

        if(!empty($_POST))
        {
            $name = htmlspecialchars(filter_input(INPUT_POST, 'name'));
            $imgPath = filter_input(INPUT_POST, 'fileToUpload');


            if ($name) {
                if (empty($id)) {
                    //save new
                    $currentId = $this->partners->addRecord($name);

                    if (isset($_FILES)) {
                        $fileUploadErrorMessage = FileManager::uploadFile('partners', $currentId, LOGO_PATH);
                    }
                    $this->addFlash("success", "Partenaire enregistré !" . $fileUploadErrorMessage, $name);
                }
                else {
                    //update
                    $currentId = $id;
                    $this->partners->updateData($id, $name);

                    if (isset($_FILES)) {
                        $fileUploadErrorMessage = FileManager::uploadFile('partners', $currentId, LOGO_PATH);
                    }
                    $this->addFlash("success",  "Données modifiées !" . $fileUploadErrorMessage, $name);
                }
            }
            else {
                $this->addFlash("danger", 'Le champ Nom/Titre est obligatoire');
            }
            $this->redirectTo('?ctrl=partnersAdmin&action=index');
        }

        return $this->render(self::CTRL_VIEW . "form.php", [
            'imgPath' => $imgPath ?: null,
            'name' => $name ?: null,
            'editMode' => $editMode,
            'pageTitle' => $id ? 'Modifier Partenaire' : 'Nouveau Partenaire',
        ]);
    }

}