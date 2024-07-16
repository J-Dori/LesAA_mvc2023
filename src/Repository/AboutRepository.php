<?php
namespace App\Repository;

use App\Entity\About;
use App\Service\AbstractManager;

class AboutRepository extends AbstractManager
{
    const CLASS_NAME = About::class;

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM about
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findAll($order = 'ASC'): array
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM about
             ORDER BY timeOrder $order"
        );
    }

    public function findAllActif($order = 'ASC'): array
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM about
             WHERE active = 1
             ORDER BY timeOrder $order"
        );
    }

    public function incrementLastTimeOrder(): int
    {
        $query = $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM about
             ORDER BY timeOrder DESC
             LIMIT 1"
        );

        return empty($query) ? 1 : $query->getTimeOrder() + 1;
    }

    public function addRecord($timeOrder, $date, $title, $text, $active)
    {
        $this->executeQuery(
            "INSERT INTO about (timeOrder, date, title, text, active)
            VALUES (:timeOrder, :date, :title, :text, :active)",
            [
                ":timeOrder" => $timeOrder,
                ":date" => $date,
                ":title" => $title,
                ":text" => $text,
                ":active" => !empty($active),
            ]
        );
        return self::$pdo->lastInsertId();
    }

    public function updateData($id, $timeOrder, $date, $title, $text, $active) {
        return $this->executeQuery(
             "UPDATE about 
             SET timeOrder = :timeOrder,
                 date = :date,
                 title = :title,
                 text = :text,
                 active = :active
             WHERE id = :id",
             [
                 ":id" => $id,
                 ":timeOrder" => $timeOrder,
                 ":date" => $date,
                 ":title" => $title,
                 ":text" => $text,
                 ":active" => !empty($active),
             ]
         );
     }

    public function addImage($id, $newFile)
    {
        $this->executeQuery(
            "UPDATE about
            SET
                imgPath = :newFile
            WHERE id = :id",
            [
                ":id" => $id,
                ":newFile" => $newFile,
            ]
        );
    }

    public function removeImage($id)
    {
        $this->executeQuery(
            "UPDATE about
            SET
                imgPath = null
            WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }

    public function deleteRecord($id)
    {
        $this->executeQuery(
            "DELETE FROM about
            WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }
}
