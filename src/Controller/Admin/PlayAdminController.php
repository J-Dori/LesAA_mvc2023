<?php
namespace App\Controller\Admin;

use AllowDynamicProperties;
use App\Repository\ContactRepository;
use App\Repository\PlayRepository;
use App\Repository\PlayRolesRepository;
use App\Service\AbstractController;
use App\Service\FileManager;
use App\Service\Session;

#[AllowDynamicProperties] class PlayAdminController extends AbstractController
{
    const CTRL_VIEW = 'admin/play/';
    public function __construct()
    {
        $this->play = new PlayRepository();
        $this->playRoles = new PlayRolesRepository();
        $this->contact = new ContactRepository();
    }
    
    public function index(): array
    {
        Session::removeIfNotAdmin();

        return $this->render(self::CTRL_VIEW . "index.php", [
            'plays' => $this->play->findAllYearDesc(),
            'pageTitle' => 'Liste de Pièces',
        ]);
    }

    public function view(int $id): array
    {
        Session::removeIfNotAdmin();

        return $this->render(self::CTRL_VIEW . "view.php", [
            'play' => $this->play->findOneById($id),
            'playRoles' => $this->playRoles->playRoles_actor_ByPlayId($id),
            'contact' => $this->contact->findActive(),
            'pageTitle' => 'Pièce - Aperçu',

        ]);
    }

    // @TODO onDelete unlink image - ex: PartnersAdminCtrl

    public function form(int $id = null): array
    {
        Session::removeIfNotAdmin();

        $editMode = null;
        $fileUploadErrorMessage = null;

        $year = null;
        $title = null;
        $description = null;
        $dateStart = null;
        $dateEnd = null;
        $active = null;
        $activeText = null;
        $videoPath = null;
        $imgPath = null;

        //editMode
        if ($id && empty($_POST) && $play = $this->play->findOneById($id)) {
            $editMode = '&id='.$id;

            $year = $play->getYear() ? $play->getYear() : null;
            $title = $play->getTitle() ? $play->getTitle() : null;
            $description = htmlspecialchars_decode($play->getDescription() ? $play->getDescription() : null);
            $dateStart = $play->getDateStart() ? date_format($play->getDateStart(), 'Y-m-d') : null;
            $dateEnd = $play->getDateEnd() ? date_format($play->getDateEnd(), 'Y-m-d') : null;
            $active = $play->getActiveText() ? $play->getActive() : null;
            $activeText = $play->getActiveText() ? $play->getActiveText() : null;
            $videoPath = $play->getVideoPath() ? $play->getVideoPath() : null;
            $imgPath = $play->getImgPath() ? $play->getImgPath() : null;
        }

        if(!empty($_POST))
        {
            $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT);
            $title = htmlspecialchars(filter_input(INPUT_POST, 'title'));
            $description = htmlspecialchars(filter_input(INPUT_POST, 'description'));
            $dateStart = htmlspecialchars(filter_input(INPUT_POST, 'dateStart'));
            $dateEnd = htmlspecialchars(filter_input(INPUT_POST, 'dateEnd'));
            $active = filter_input(INPUT_POST, 'active', FILTER_VALIDATE_BOOLEAN);
            $activeText = htmlspecialchars(filter_input(INPUT_POST, 'activeText'));
            $videoPath = filter_input(INPUT_POST, 'videoPath', FILTER_SANITIZE_URL);
            $imgPath = filter_input(INPUT_POST, 'fileToUpload');

            if ($title && $year && $description && $dateStart && $dateEnd) {
                if (empty($id)) {
                    //save new
                    $currentId = $this->play->addRecord($title, $year, $description, $videoPath, $activeText, $dateStart, $dateEnd, $active);

                    if (isset($_FILES)) {
                        $fileUploadErrorMessage = FileManager::uploadFile('play', $currentId, IMG_PLAY_FLYERS);
                    }
                    $this->addFlash("success", "Pièce enregistrée !" . $fileUploadErrorMessage, $title);
                }
                else {
                    //update
                    $currentId = $id;
                    $this->play->updateData($currentId, $title, $year, htmlspecialchars_decode($description), $videoPath, htmlspecialchars_decode($activeText), $dateStart, $dateEnd, $active);

                    if (isset($_FILES)) {
                        $fileUploadErrorMessage = FileManager::uploadFile('play', $currentId, IMG_PLAY_FLYERS);
                    }
                    $this->addFlash("success", "Données modifiées !" . $fileUploadErrorMessage, $title);
                }
                $this->redirectTo('?ctrl=playAdmin&action=view&id='.$currentId);
            }
            else {
                $this->addFlash("danger", 'Les champs Année, Titre, Description, Date Début/Fin sont obligatoires');
            }
        }

        return $this->render(self::CTRL_VIEW . "form.php", [
            'year' => $year ?: null,
            'title' => $title ?: null,
            'description' => $description ?: null,
            'dateStart' => $dateStart ?: null,
            'dateEnd' => $dateEnd ?: null,
            'active' => $active ?: null,
            'activeText' => $activeText ?: null,
            'videoPath' => $videoPath ?: null,
            'imgPath' => $imgPath ?: null,
            'editMode' => $editMode,
            'pageTitle' => $id ? 'Modifier Pièce' : 'Nouvelle Pièce',
        ]);
    }

}