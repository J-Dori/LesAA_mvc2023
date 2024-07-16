<?php
namespace App\Repository;

use App\Entity\Partners;
use App\Service\AbstractManager;

class PartnersRepository extends AbstractManager
{
    const CLASS_NAME = Partners::class;

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM partners
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findAll()
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM partners"
        );
    }

    public function addRecord($name)
    {
        $this->executeQuery(
            "INSERT INTO partners (name)
            VALUES (:name)",
            [
                ":name" => $name,
            ]
        );
        return self::$pdo->lastInsertId();
    }

    public function updateData($id, $name) {
        return $this->executeQuery(
             "UPDATE partners 
             SET name = :name
             WHERE id = :id",
             [
                 ":id" => $id,
                 ":name" => $name,
             ]
         );
     }

    public function addImage($id, $newFile)
    {
        $this->executeQuery(
            "UPDATE partners
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
            "UPDATE partners
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
            "DELETE FROM partners
            WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }

}