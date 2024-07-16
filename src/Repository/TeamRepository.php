<?php
namespace App\Repository;

use App\Entity\Team;
use App\Service\AbstractManager;

class TeamRepository extends AbstractManager
{
    const CLASS_NAME = Team::class;

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM team
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findAll(): array
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM team
             ORDER BY name ASC"
        );
    }

    public function addRecord($name, $role, $roleOrder, $description = null)
    {
        $this->executeQuery(
            "INSERT INTO team (name, role, roleOrder, description)
            VALUES (:name, :role, :roleOrder, :description)",
            [
                ":name" => ucfirst($name),
                ":role" => $role,
                ":roleOrder" => $roleOrder,
                ":description" => $description,
            ]
        );
        return self::$pdo->lastInsertId();
    }

    public function updateData($id, $name, $role, $roleOrder, $description) {
        return $this->executeQuery(
             "UPDATE team 
             SET name = :name,
                 role = :role,
                 roleOrder = :roleOrder,
                 description = :description
             WHERE id = :id",
             [
                 ":id" => $id,
                 ":name" => ucfirst($name),
                 ":role" => $role,
                 ":roleOrder" => $roleOrder,
                 ":description" => $description,
             ]
         );
     }

    public function addImage($id, $newFile)
    {
        $this->executeQuery(
            "UPDATE team
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
            "UPDATE team
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
            "DELETE FROM team
            WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }

    public function teamByRoleOrder(): array
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM team
             ORDER BY roleOrder ASC"
        );
    }

}
