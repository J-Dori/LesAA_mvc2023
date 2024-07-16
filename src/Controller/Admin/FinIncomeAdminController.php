<?php
namespace App\Controller\Admin;

use AllowDynamicProperties;
use App\Repository\FinCategoryRepository;
use App\Repository\FinIncomeRepository;
use App\Repository\FinSeasonRepository;
use App\Service\AbstractController;
use App\Service\Session;

#[AllowDynamicProperties] class FinIncomeAdminController extends AbstractController
{
    const ADMIN_VIEW = 'admin/financial/income/';

    public function __construct()
    {
        $this->season = new FinSeasonRepository();
        $this->category = new FinCategoryRepository();
        $this->income = new FinIncomeRepository();
    }
    
    public function index(): array
    {
        Session::removeIfNotAdminOrAccount();

        $season = $this->season->findActif();

        // check if url has filterBy
        $urlFilterBy = $_GET['filterBy'] ?? 'finNumber';
        // predefined filter and array of filters
        $filterSQL = 'fin.date DESC';
        $filtersArray = [
            'finNumber' => 'fin.finNumber DESC',
            'date' => 'fin.date DESC',
            'category' => 'categ.title ASC',
            'mop' => 'fin.mop ASC',
            'amount' => 'fin.amount DESC'
        ];

        if (isset($filtersArray[$urlFilterBy])) {
            $filterSQL = $filtersArray[$urlFilterBy];
        }

        return $this->render(self::ADMIN_VIEW . "index.php", [
            'season' => $season,
            'incomes' => $this->income->findAllInActiveSeason($filterSQL),
            'totalIncomes' => $this->income->getTotalAmountInActiveSeason(),
            'totalByCategory' => $this->income->getTotalAmountByCategory(),
            'totalByMop' => $this->income->getTotalAmountByMop(),
            'pageTitle' => 'Trésorerie : Revenus',
        ]);
    }

    public function view(int $id): array
    {
        Session::removeIfNotAdminOrAccount();

        $returnToCtrl = $_GET['return'] ?? 'finIncome';

        if (empty($id) || empty($this->income->findOneById($id))) {
            $this->addFlash("danger", 'Revenu introuvable', 'Erreur');
            $this->redirectTo('?ctrl='. $returnToCtrl .'Admin&action=index');
        }

        $income = $this->income->findOneById($id);

        return $this->render(self::ADMIN_VIEW . "view.php", [
            'season' => $this->season->findActif(),
            'income' => $income,
            'returnToCtrl' => $returnToCtrl,
            'pageTitle' => 'Trésorerie : Revenus',
        ]);
    }

    public function print(): ?array
    {
        Session::removeIfNotAdminOrAccount();

        $urlPrintType = $_GET['type'] ?? null;

        $viewPath = null;
        $printViewPath = [
            'category' => 'admin/print/income/category.php',
            'mp' => 'admin/print/income/mp.php',
            'list' => 'admin/print/income/list.php',
            'id' => 'admin/print/income/id.php',
        ];

        if (isset($printViewPath[$urlPrintType])) {
            $viewPath = $printViewPath[$urlPrintType];
        }

        if ( !empty($urlPrintType) && !empty($viewPath) ) {
            $results = $this->income->getTotalAmountByCategory();

            return $this->render($viewPath, [
                //'season' => $this->season->findActif(),
                //'results' => $results,
                //'pageTitle' => 'Trésorerie : Imprimer',
            ]);
        }

        $this->addFlash("danger", 'Impossible imprimer ou aucune donnée trouvée.', 'Erreur');
        return $this->redirectTo('?ctrl=finIncomeAdmin&action=index');
    }

    public function delete(int $id): void
    {
        Session::removeIfNotAdmin();

        if ($income = $this->income->findOneById($id)) {
            try {
                $this->income->delete($id);
                $this->addFlash('success', 'Revenu nº ' . $income->getFinNumber() .' supprimé avec success.', 'Suppression');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'Une erreur est survenue. Contactez le WebMaster.', 'Suppression');
            }
        }

        $this->redirectTo('?ctrl=finIncomeAdmin&action=index');
    }

    public function form(int $id = null): array
    {
        Session::removeIfNotAdminOrAccount();

        $season = $this->season->findActif();

        if (empty($season)) {
            $this->addFlash("danger", 'Aucune Saison active.', 'Erreur');
            $this->redirectTo('?ctrl=finSeason&action=list');
        }

        $editMode = null;

        $finCategory = null;
        $finNumber = $this->income->incrementLastFinNumber($season);
        $date = null;
        $description = null;
        $amount = null;
        $mop = null;
        $docRef = null;
        $createdBy = null;
        $createdAt = null;
        $updatedBy = null;
        $updatedAt = null;

        //editMode
        if ($id && empty($_POST) && $season && $income = $this->income->findOneById($id)) {
            $editMode = '&id='.$id;

            $finCategory = $income->getFinCategory();
            $finNumber = $income->getFinNumber();
            $date = $income->getDate();
            $description = $income->getDescription();
            $amount = $income->getAmount();
            $mop = $income->getMop();
            $docRef = $income->getDocRef();
            $createdBy = $income->getCreatedBy();
            $createdAt = $income->getCreatedAt();
            $updatedBy = $income->getUpdatedBy();
            $updatedAt = $income->getUpdatedAt();
        }

        if(!empty($_POST))
        {
            $finCategory = filter_input(INPUT_POST, 'finCategory', FILTER_SANITIZE_NUMBER_INT);
            $finNumber = filter_input(INPUT_POST, 'finNumber', FILTER_SANITIZE_NUMBER_INT);
            $date = htmlspecialchars(filter_input(INPUT_POST, 'date'));
            $description = htmlspecialchars(filter_input(INPUT_POST, 'description'));
            $amount = htmlspecialchars(filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT));
            $mop = htmlspecialchars(filter_input(INPUT_POST, 'mop'));
            $docRef = htmlspecialchars(filter_input(INPUT_POST, 'docRef'));

            if ($finCategory && $finNumber && $date && $mop && $amount) {
                if (empty($id)) {
                    //save new
                    $createdBy = Session::getUser() ? Session::getUser()->fullname() : '';
                    $this->income->add($season, $finCategory, $finNumber, $date, $description, $amount, $mop, $docRef, $createdBy);
                    $this->addFlash("success", "Revenu nº $finNumber enregistré !");
                }
                else {
                    //update
                    $updatedBy = Session::getUser() ? Session::getUser()->fullname() : '';
                    $this->income->update($id, $season->getId(), $finCategory, $finNumber, $date, $description, $amount, $mop, $docRef, $updatedBy);
                    $this->addFlash("success",  "Données modifiées !");
                }
                // update Season Budget values
                $this->season->updateBudget();
            }
            else {
                $this->addFlash("danger", 'Les champs Revenu nº, Date, Catégorie, MP et Montant sont obligatoires');
            }

            $this->redirectTo('?ctrl=finIncomeAdmin&action=index');
        }

        return $this->render(self::ADMIN_VIEW . "form.php", [
            'editMode' => $editMode,

            'season' => $season,

            'finCategory' => $finCategory,
            'finNumber' => $finNumber,
            'date' => $date,
            'description' => $description,
            'amount' => $amount,
            'mop' => $mop,
            'docRef' => $docRef,
            'createdBy' => $createdBy,
            'createdAt' => $createdAt,
            'updatedBy' => $updatedBy,
            'updatedAt' => $updatedAt,

            'pageTitle' => $id ? 'Modifier Revenu nº ' . ($finNumber ?? '') : 'Ajouter Revenu',
        ]);
    }

}