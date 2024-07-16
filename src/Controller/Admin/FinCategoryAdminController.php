<?php
namespace App\Controller\Admin;

use AllowDynamicProperties;
use App\Repository\FinCategoryRepository;
use App\Service\AbstractController;
use App\Service\Session;

#[AllowDynamicProperties] class FinCategoryAdminController extends AbstractController
{
    const ADMIN_VIEW = 'admin/financial/category/';

    public function __construct()
    {
        $this->category = new FinCategoryRepository();
    }
    
    public function index(): array
    {
        Session::removeIfNotAdminOrAccount();

        return $this->render(self::ADMIN_VIEW . "index.php", [
            'categories' => $this->category->findAll(),
            'pageTitle' => 'Trésorerie : Catégories',
        ]);
    }

    public function form(int $id = null): array
    {
        Session::removeIfNotAdminOrAccount();

        $editMode = null;

        $title = null;

        //editMode
        if ($id && empty($_POST) && $category = $this->category->findOneById($id)) {
            $editMode = '&id='.$id;

            $title = $category->getTitle() ? $category->getTitle() : null;
        }

        if(!empty($_POST))
        {
            $title = htmlspecialchars(filter_input(INPUT_POST, 'title'));

            if ($title) {
                if (empty($id)) {
                    //save new
                    $this->category->add($title);
                    $this->addFlash("success", "Catégorie enregistrée !");
                }
                else {
                    //update
                    $this->category->update($id, $title);
                    $this->addFlash("success",  "Données modifiées !");
                }
            }
            else {
                $this->addFlash("danger", 'Le champ Titre est obligatoire');
            }
            $this->redirectTo('?ctrl=finCategoryAdmin&action=index');
        }

        return $this->render(self::ADMIN_VIEW . "form.php", [
            'title' => $title ?: null,
            'editMode' => $editMode,
            'pageTitle' => $id ? 'Modifier Catégorie' : 'Nouvelle Catégorie',
        ]);
    }

}