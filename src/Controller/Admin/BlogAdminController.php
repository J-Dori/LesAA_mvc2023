<?php
namespace App\Controller\Admin;

use AllowDynamicProperties;
use App\Repository\BlogRepository;
use App\Repository\HeadersRepository;
use App\Service\AbstractController;
use App\Service\FileManager;
use App\Service\Session;

#[AllowDynamicProperties] class BlogAdminController extends AbstractController
{
    const CTRL_VIEW = 'admin/blog/';
    public function __construct()
    {
        $this->blog = new BlogRepository();
        $this->headers = new HeadersRepository();
    }
    
    public function index(): array
    {
        Session::removeIfNotAdmin();

        return $this->render(self::CTRL_VIEW . "index.php", [
            'blog' => $this->blog->findAll('DESC'),
            'headers' => $this->headers->findOneById(), //id = 1 by default
            'pageTitle' => 'Articles',
        ]);
    }

    public function preview(): array
    {
        Session::removeIfNotAdmin();

        return $this->render(self::CTRL_VIEW . "preview.php", [
            'blog' => $this->blog->findAllActif(),
            'headers' => $this->headers->findOneById(), //id = 1 by default
            'pageTitle' => 'Article : Aperçu',
            'cssFile' => 'blog.css',
        ]);
    }

    public function delete(int $id): void
    {
        Session::removeIfNotAdmin();

        if ($partner = $this->blog->findOneById($id)) {
            try {
                $this->blog->deleteRecord($id);
                $message = 'Element supprimé';
                if (file_exists(IMG_BLOG . $partner->getImgPath())) {
                    unlink(IMG_BLOG . $partner->getImgPath());
                    $message = 'Element et image supprimés';
                }
                $this->addFlash('success', $message.' avec success.', 'Suppression');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'Une erreur est survenue. Contactez le WebMaster.', 'Suppression');
            }
        }

        $this->redirectTo('?ctrl=blogAdmin&action=index');
    }

    public function form(int $id = null): array
    {
        Session::removeIfNotAdmin();

        $editMode = null;
        $fileUploadErrorMessage = null;

        $timeOrder = $this->blog->incrementLastTimeOrder();
        $date = null;
        $title = null;
        $text = null;
        $imgPath = null;
        $active = false;

        //editMode
        if ($id && empty($_POST) && $blog = $this->blog->findOneById($id)) {
            $editMode = '&id='.$id;

            $timeOrder = $blog->getTimeOrder() ? $blog->getTimeOrder() : null;
            $date = $blog->getDate() ? $blog->getDate() : null;
            $title = $blog->getTitle() ? $blog->getTitle() : null;
            $text = $blog->getText() ? $blog->getText() : null;
            $imgPath = $blog->getImgPath() ? $blog->getImgPath() : null;
            $active = $blog->isActive();
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
                    $currentId = $this->blog->addRecord($timeOrder, $date, $title, $text, $active);

                    if (isset($_FILES)) {
                        $fileUploadErrorMessage = FileManager::uploadFile('blog', $currentId, IMG_BLOG);
                    }
                    $this->addFlash("success", "Article enregistré !" . $fileUploadErrorMessage, $date.' : '.$title);
                }
                else {
                    //update
                    $currentId = $id;
                    $this->blog->updateData($id, $timeOrder, $date, $title, $text, $active);

                    if (isset($_FILES)) {
                        $fileUploadErrorMessage = FileManager::uploadFile('blog', $currentId, IMG_BLOG);
                    }
                    $this->addFlash("success",  "Données modifiées !" . $fileUploadErrorMessage, $date.' : '.$title);
                }
            }
            else {
                $this->addFlash("danger", 'Tous les champs sont obligatoires');
            }
            $this->redirectTo('?ctrl=blogAdmin&action=index');
        }

        return $this->render(self::CTRL_VIEW . "form.php", [
            'active' => $active,
            'timeOrder' => $timeOrder ?: null,
            'date' => $date ?: null,
            'title' => $title ?: null,
            'text' => $text ?: null,
            'imgPath' => $imgPath ?: null,
            'editMode' => $editMode,
            'pageTitle' => $id ? 'Modifier Article' : 'Nouveau Article',
        ]);
    }
}
