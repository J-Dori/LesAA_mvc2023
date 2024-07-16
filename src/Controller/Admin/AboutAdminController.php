<?php
namespace App\Controller\Admin;

use AllowDynamicProperties;
use App\Repository\AboutRepository;
use App\Repository\HeadersRepository;
use App\Service\AbstractController;
use App\Service\FileManager;
use App\Service\Session;

#[AllowDynamicProperties] class AboutAdminController extends AbstractController
{
    const CTRL_VIEW = 'admin/about/';
    public function __construct()
    {
        $this->about = new AboutRepository();
        $this->headers = new HeadersRepository();
    }
    
    public function index(): array
    {
        Session::removeIfNotAdmin();

        return $this->render(self::CTRL_VIEW . "index.php", [
            'about' => $this->about->findAll('DESC'),
            'headers' => $this->headers->findOneById(), //id = 1 by default
            'pageTitle' => 'Parcours',
        ]);
    }

    public function preview(): array
    {
        Session::removeIfNotAdmin();

        return $this->render(self::CTRL_VIEW . "preview.php", [
            'about' => $this->about->findAllActif(),
            'headers' => $this->headers->findOneById(), //id = 1 by default
            'pageTitle' => 'Parcours : Aperçu',
        ]);
    }

    public function delete(int $id): void
    {
        Session::removeIfNotAdmin();

        if ($partner = $this->about->findOneById($id)) {
            try {
                $this->about->deleteRecord($id);
                $message = 'Element supprimé';
                if (file_exists(IMG_ABOUT . $partner->getImgPath())) {
                    unlink(IMG_ABOUT . $partner->getImgPath());
                    $message = 'Element et image supprimés';
                }
                $this->addFlash('success', $message.' avec success.', 'Suppression');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'Une erreur est survenue. Contactez le WebMaster.', 'Suppression');
            }
        }

        $this->redirectTo('?ctrl=aboutAdmin&action=index');
    }

    public function form(int $id = null): array
    {
        Session::removeIfNotAdmin();

        $editMode = null;
        $fileUploadErrorMessage = null;

        $timeOrder = $this->about->incrementLastTimeOrder();;
        $date = null;
        $title = null;
        $text = null;
        $imgPath = null;
        $active = false;

        //editMode
        if ($id && empty($_POST) && $about = $this->about->findOneById($id)) {
            $editMode = '&id='.$id;

            $timeOrder = $about->getTimeOrder() ? $about->getTimeOrder() : null;
            $date = $about->getDate() ? $about->getDate() : null;
            $title = $about->getTitle() ? $about->getTitle() : null;
            $text = $about->getText() ? $about->getText() : null;
            $imgPath = $about->getImgPath() ? $about->getImgPath() : null;
            $active = $about->isActive();
        }

        if(!empty($_POST))
        {
            $timeOrder = htmlspecialchars(filter_input(INPUT_POST, 'timeOrder'));
            $date = htmlspecialchars(filter_input(INPUT_POST, 'date'));
            $title = htmlspecialchars(filter_input(INPUT_POST, 'title'));
            $text = htmlspecialchars_decode(filter_input(INPUT_POST, 'text'));
            $imgPath = filter_input(INPUT_POST, 'fileToUpload');
            $active = filter_input(INPUT_POST, 'active', FILTER_VALIDATE_BOOLEAN);

            if ($timeOrder && $date && $title) {
                if (empty($id)) {
                    //save new
                    $currentId = $this->about->addRecord($timeOrder, $date, $title, $text, $active);

                    if (isset($_FILES)) {
                        $fileUploadErrorMessage = FileManager::uploadFile('about', $currentId, IMG_ABOUT);
                    }
                    $this->addFlash("success", "Parcours enregistré !" . $fileUploadErrorMessage, $date.' : '.$title);
                }
                else {
                    //update
                    $currentId = $id;
                    $this->about->updateData($id, $timeOrder, $date, $title, $text, $active);

                    if (isset($_FILES)) {
                        $fileUploadErrorMessage = FileManager::uploadFile('about', $currentId, IMG_ABOUT);
                    }
                    $this->addFlash("success",  "Données modifiées !" . $fileUploadErrorMessage, $date.' : '.$title);
                }
            }
            else {
                $this->addFlash("danger", 'Tous les champs sont obligatoires');
            }
            $this->redirectTo('?ctrl=aboutAdmin&action=index');
        }

        return $this->render(self::CTRL_VIEW . "form.php", [
            'active' => $active,
            'timeOrder' => $timeOrder ?: null,
            'date' => $date ?: null,
            'title' => $title ?: null,
            'text' => $text ?: null,
            'imgPath' => $imgPath ?: null,
            'editMode' => $editMode,
            'pageTitle' => $id ? 'Modifier Parcours' : 'Nouveau Parcours',
        ]);
    }
}
