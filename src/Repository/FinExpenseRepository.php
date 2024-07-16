<?php
namespace App\Repository;

use App\Entity\Financial\FinExpense;
use App\Service\AbstractManager;
use App\Service\Session;

class FinExpenseRepository extends AbstractManager
{
    const CLASS_NAME = FinExpense::class;

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM financial__finexpense
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findAll(): array
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM financial__finexpense
             ORDER BY date DESC"
        );
    }

    public function findAllInActiveSeason(): array
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM financial__finexpense fin
             INNER JOIN financial__finseason fman ON fin.finSeason_id = fman.id
             WHERE fman.active = 1
             ORDER BY date DESC"
        );
    }

    public function getTotalAmountInActiveSeason(): ?string
    {
        return $this->getOneOrNullValue(
            "SELECT SUM(fin.amount) as total
             FROM financial__finexpense fin
             INNER JOIN financial__finseason fman ON fin.finSeason_id = fman.id
             WHERE fman.active = 1"
        );
    }

    public function getTotalAmountByCategory(): ?array
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT DISTINCT fin.finCategory_id, SUM(fin.amount) as totalByCategory
             FROM financial__finexpense fin
             INNER JOIN financial__finseason fman ON fin.finSeason_id = fman.id
             WHERE fman.active = 1
             GROUP BY fin.finCategory_id"
        );
    }

    public function incrementLastFinNumber($season)
    {
        $q = $this->getOneOrNullValue(
            "SELECT MAX(finNumber)
             FROM financial__finexpense
             WHERE finSeason_id = :season", [':season' => $season]
        );

        return empty($q) ? 1 : $q + 1;
    }

    public function add($year, $play, $budgetStart, $budgetEnd, $active)
    {
        $this->executeQuery(
            "INSERT INTO financial__finexpense (year, play_id, budgetStart, budgetEnd, active, createdBy)
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

        return self::$pdo->lastInsertId();
    }

    public function update($id, $year, $play, $budgetStart, $budgetEnd, $active)
    {
        return $this->executeQuery(
             "UPDATE financial__finexpense 
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

    }


    public function delete($id)
    {
        $this->executeQuery(
            "DELETE FROM financial__finexpense
            WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }
}
