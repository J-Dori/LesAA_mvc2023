<?php
namespace App\Repository;

use App\Entity\Financial\FinCategory;
use App\Service\AbstractManager;

class FinCategoryRepository extends AbstractManager
{
    const CLASS_NAME = FinCategory::class;

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM financial__fincategory
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findAll(): array
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM financial__fincategory
             ORDER BY title"
        );
    }

    public function add($title)
    {
        $this->executeQuery(
            "INSERT INTO financial__fincategory (title)
            VALUES (:title)",
            [
                ":title" => $title
            ]
        );

        return self::$pdo->lastInsertId();
    }

    public function update($id, $title)
    {
        return $this->executeQuery(
             "UPDATE financial__fincategory 
             SET title = :title
             WHERE id = :id",
             [
                 ":id" => $id,
                 ":title" => $title
             ]
         );
    }

    public function delete($id)
    {
        $this->executeQuery(
            "DELETE FROM financial__fincategory
            WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }
}
