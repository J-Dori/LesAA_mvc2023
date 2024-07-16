<?php
namespace App\Controller\Admin;

use AllowDynamicProperties;
use App\Repository\FinExpenseRepository;
use App\Repository\FinIncomeRepository;
use App\Repository\FinSeasonRepository;
use App\Repository\PlayRepository;
use App\Service\AbstractController;
use App\Service\CommonFunctions;
use App\Service\Session;

#[AllowDynamicProperties] class FinSeasonAdminController extends AbstractController
{
    const ADMIN_VIEW = 'admin/financial/season/';

    public function __construct()
    {
        $this->season = new FinSeasonRepository();
        $this->income = new FinIncomeRepository();
        $this->expense = new FinExpenseRepository();
        $this->play = new PlayRepository();
    }
    
    public function index(): array
    {
        Session::removeIfNotAdminOrAccount();

        $season = $this->season->findActif();

        return $this->render(self::ADMIN_VIEW . "index.php", [
            'season' => $season,
            'incomes' => $this->income->findAllInActiveSeason(),
            'expenses' => $this->expense->findAllInActiveSeason(),
            'totalIncomes' => $this->income->getTotalAmountInActiveSeason(),
            'totalExpenses' => $this->expense->getTotalAmountInActiveSeason(),
            'pageTitle' => 'Trésorerie : Saison ' . (!empty($season) ? $season->getYear() : ''),
        ]);
    }

    public function seasonList(): array
    {
        Session::removeIfNotAdminOrAccount();

        return $this->render(self::ADMIN_VIEW . "list.php", [
            'seasons' => $this->season->findAll(),
            'pageTitle' => 'Trésorerie : Saisons',
        ]);
    }

    public function form(int $id = null): array
    {
        Session::removeIfNotAdminOrAccount();

        $editMode = null;

        $year = null;
        $play = null;
        $budgetStart = null;
        $budgetEnd = null;
        $active = false;
        $createdBy = null;
        $updatedBy = null;

        if(empty($id))
        {
            $budgetStart = $this->season->findLastInsertedSession() ? $this->season->findLastInsertedSession()->getBudgetEnd() : 0;
        }

        //editMode
        if ($id && empty($_POST) && $season = $this->season->findOneById($id)) {
            $editMode = '&id='.$id;

            $year = $season->getYear() ? $season->getYear() : null;
            $play = $season->getPlay() ? $season->getPlay() : null;
            $budgetStart = $season->getBudgetStart() ? $season->getBudgetStart() : null;
            $budgetEnd = $season->getBudgetEnd() ? $season->getBudgetEnd() : null;
            $active = $season->isActive();
            $createdBy = $season->getCreatedBy() ? $season->getCreatedBy() : null;
            $updatedBy = $season->getUpdatedBy() ? $season->getUpdatedBy() : null;
        }

        if(!empty($_POST))
        {
            $year = htmlspecialchars(filter_input(INPUT_POST, 'year'));
            $play = filter_input(INPUT_POST, 'play', FILTER_SANITIZE_NUMBER_INT);
            $budgetStart = filter_input(INPUT_POST, 'budgetStart', FILTER_VALIDATE_FLOAT);
            $budgetEnd = filter_input(INPUT_POST, 'budgetEnd', FILTER_VALIDATE_FLOAT);
            $active = filter_input(INPUT_POST, 'active', FILTER_VALIDATE_BOOLEAN);

            if ($year && $play) {
                if (empty($id)) {
                    //save new
                    $this->season->add($year, $play, CommonFunctions::convertToMoney($budgetStart, false), CommonFunctions::convertToMoney($budgetEnd, false), $active);
                    $this->addFlash("success", "Saison enregistrée !");
                }
                else {
                    //update
                    $this->season->update($id, $year, $play, $budgetStart, $budgetEnd, $active);
                    $this->addFlash("success",  "Données modifiées !");
                }
            }
            else {
                $this->addFlash("danger", 'Les champs Année et Pièce sont obligatoires');
            }
            $this->redirectTo('?ctrl=finSeasonAdmin&action=index');
        }

        return $this->render(self::ADMIN_VIEW . "form.php", [
            'year' => $year ?: null,
            'play' => $play ?: null,
            'budgetStart' => $budgetStart ?: null,
            'budgetEnd' => $budgetEnd ?: null,
            'active' => $active ?: null,
            'createdBy' => $createdBy ?: null,
            'updatedBy' => $updatedBy ?: null,
            'playsList' => $this->play->findAllYearDesc(),
            'editMode' => $editMode,
            'pageTitle' => $id ? 'Modifier Saison' : 'Nouvelle Saison',
        ]);
    }

}