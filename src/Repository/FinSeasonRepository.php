<?php
namespace App\Repository;

use AllowDynamicProperties;
use App\Entity\Financial\FinSeason;
use App\Service\AbstractManager;
use App\Service\Session;

#[AllowDynamicProperties] class FinSeasonRepository extends AbstractManager
{
    const CLASS_NAME = FinSeason::class;

    public function __construct()
    {
        $this->incomeRepo = new FinIncomeRepository();
        $this->expenseRepo = new FinExpenseRepository();
    }

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM financial__finseason
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findAll(): array
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM financial__finseason
             ORDER BY year DESC"
        );
    }

    public function findLastInsertedSession()
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT id
             FROM financial__finseason
             ORDER BY id DESC
             LIMIT 1"
        );
    }

    public function findActif()
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM financial__finseason
             WHERE active = 1"
        );
    }

    public function add($year, $play, $budgetStart, $budgetEnd, $active)
    {
        $this->executeQuery(
            "INSERT INTO financial__finseason (year, play_id, budgetStart, budgetEnd, active, createdBy)
            VALUES (:year, :play, :budgetStart, :budgetEnd, :active, :createdBy)",
            [
                ":year" => $year,
                ":play" => $play,
                ":budgetStart" => $budgetStart,
                ":budgetEnd" => $budgetEnd,
                ":active" => !empty($active),
                ":createdBy" => Session::getUser()->fullname(),
            ]
        );

        self::setActive(self::$pdo->lastInsertId(), $active);

        return self::$pdo->lastInsertId();
    }

    public function update($id, $year, $play, $budgetStart, $budgetEnd, $active)
    {
        $this->executeQuery(
             "UPDATE financial__finseason 
             SET year = :year,
                 play_id = :play,
                 budgetStart = :budgetStart,
                 budgetEnd = :budgetEnd,
                 active = :active,
                 updatedBy = :updatedBy
             WHERE id = :id",
             [
                 ":id" => $id,
                 ":year" => $year,
                 ":play" => $play,
                 ":budgetStart" => $budgetStart,
                 ":budgetEnd" => $budgetEnd,
                 ":active" => !empty($active),
                 ":updatedBy" => Session::getUser()->fullname(),
             ]
         );

        self::setActive($id, $active);
    }

    public function setActive(int $id, null|int|bool $active)
    {
        if ($active == 1) {
            //If user sets a new Session Active, this will set first ALL Sessions active=0 to assure that there aren't more than 1 session set as True(1)
            $this->executeQuery(
                "UPDATE financial__finseason
                 SET active = 0",
                []
            );
        }
        $this->executeQuery(
            "UPDATE financial__finseason
             SET active = :active
            WHERE id = :id",
            [
                ":id" => $id,
                ":active" => $active
            ]
        );
    }

    public function delete($id)
    {
        $this->executeQuery(
            "DELETE FROM financial__finseason
            WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }

    public function updateBudget()
    {
        $season = self::findActif();

        if ($season) {
            $totalIncome = !empty($this->incomeRepo->getTotalAmountInActiveSeason()) ? $this->incomeRepo->getTotalAmountInActiveSeason() : 0;
            $totalExpense = !empty($this->expenseRepo->getTotalAmountInActiveSeason()) ? $this->expenseRepo->getTotalAmountInActiveSeason() : 0;
            $budgetStart = !empty($season->getBudgetStart()) ? $season->getBudgetStart() : 0;
            $budgetEnd = $budgetStart + ($totalIncome - $totalExpense);

            $this->executeQuery(
                "UPDATE financial__finseason
                 SET budgetEnd = :budgetEnd,
                     updatedBy = :updatedBy
                 WHERE id = :season",
                [
                    ":season" => $season->getId(),
                    ":budgetEnd" => $budgetEnd,
                    ":updatedBy" => Session::getUser()->fullname(),
                ]
            );
        }
    }
}
