<?php
namespace App\Repository;

use App\Entity\Financial\FinIncome;
use App\Service\AbstractManager;
use App\Service\Session;

class FinIncomeRepository extends AbstractManager
{
    const CLASS_NAME = FinIncome::class;

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM financial__finincome
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findAll(): array
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM financial__finincome
             ORDER BY date DESC"
        );
    }

    public function findAllInActiveSeason(?string $filter = 'fin.date DESC'): array
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT fin.*
             FROM financial__finincome fin
             INNER JOIN financial__finseason fman ON fin.finSeason_id = fman.id
             INNER JOIN financial__fincategory categ ON fin.finCategory_id = categ.id
             WHERE fman.active = 1
             ORDER BY $filter"
        );
    }

    public function getTotalAmountInActiveSeason(): ?string
    {
        return $this->getOneOrNullValue(
            "SELECT SUM(fin.amount) as total
             FROM financial__finincome fin
             INNER JOIN financial__finseason fman ON fin.finSeason_id = fman.id
             WHERE fman.active = 1"
        );
    }

    public function getTotalAmountByCategory(): ?array
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT DISTINCT fin.finCategory_id, SUM(fin.amount) as totalByCategory, COUNT(fin.finCategory_id) as countByCategory
             FROM financial__finincome fin
             INNER JOIN financial__finseason fman ON fin.finSeason_id = fman.id
             WHERE fman.active = 1
             GROUP BY fin.finCategory_id"
        );
    }

    public function getTotalAmountByMop(): ?array
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT DISTINCT fin.mop, SUM(fin.amount) as totalByMop, COUNT(fin.mop) as countByMop
             FROM financial__finincome fin
             INNER JOIN financial__finseason fman ON fin.finSeason_id = fman.id
             WHERE fman.active = 1
             GROUP BY fin.mop
             ORDER BY fin.mop ASC"
        );
    }

    public function incrementLastFinNumber($season)
    {
        $q = $this->getOneOrNullValue(
            "SELECT MAX(finNumber)
             FROM financial__finincome
             WHERE finSeason_id = :season", [':season' => $season]
        );

        return empty($q) ? 1 : $q + 1;
    }

    public function add($season, $finCategory, $finNumber, $date, $description, $amount, $mop, $docRef, $createdBy)
    {
        $this->executeQuery(
            "INSERT INTO financial__finincome (finSeason_id, finCategory_id, finNumber, date, description, amount, mop, docRef, createdBy)
            VALUES (:season, :finCategory, :finNumber, :date, :description, :amount, :mop, :docRef, :createdBy)",
            [
                ':season' => $season,
                ':finCategory' => $finCategory,
                ':finNumber' => $finNumber,
                ':date' => $date,
                ':description' => $description,
                ':amount' => $amount,
                ':mop' => $mop,
                ':docRef' => $docRef,
                ':createdBy' => $createdBy
            ]
        );

        return self::$pdo->lastInsertId();
    }

    public function update($id, $season, $finCategory, $finNumber, $date, $description, $amount, $mop, $docRef, $updatedBy)
    {
        return $this->executeQuery(
            "UPDATE financial__finincome 
             SET finSeason_id = :season,
                 finCategory_id = :finCategory,
                 finNumber = :finNumber,
                 date = :date,
                 description = :description,
                 amount = :amount,
                 mop = :mop,
                 docRef = :docRef,
                 updatedBy = :updatedBy
             WHERE id = :id",
            [
                ":id" => $id,
                ':season' => $season,
                ':finCategory' => $finCategory,
                ':finNumber' => $finNumber,
                ':date' => $date,
                ':description' => $description,
                ':amount' => $amount,
                ':mop' => $mop,
                ':docRef' => $docRef,
                ':updatedBy' => $updatedBy
            ]
        );
    }


    public function delete($id)
    {
        $this->executeQuery(
            "DELETE FROM financial__finincome
            WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }
}
