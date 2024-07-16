<?php
namespace App\Repository;

use App\Entity\Actor;
use App\Service\AbstractManager;

class ActorRepository extends AbstractManager
{
    const CLASS_NAME = Actor::class;

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM actor
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findAll()
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM actor
             ORDER BY firstname ASC, lastname ASC"
        );
    }

    public function addRecord($firstname, $lastname, $email, $phone)
    {
        $this->executeQuery(
            "INSERT INTO actor (firstname, lastname, email, phone)
            VALUES (:firstname, :lastname, :email, :phone)",
            [
                ":firstname" => ucfirst($firstname),
                ":lastname" => mb_strtoupper($lastname),
                ":email" => mb_strtolower($email),
                ":phone" => $phone
            ]
        );
    }

    public function updateData($id, $firstname, $lastname, $email, $phone) {
        return $this->executeQuery(
             "UPDATE actor 
             SET firstname = :firstname,
                 lastname = :lastname,
                 email = :email,
                 phone = :phone
             WHERE id = :id",
             [
                ":id" => $id,
                ":firstname" => ucfirst($firstname),
                ":lastname" => mb_strtoupper($lastname),
                ":email" => mb_strtolower($email),
                ":phone" => $phone
             ]
         );
     }

    public function deleteRecord($id)
    {
        $this->executeQuery(
            "DELETE FROM actor
            WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }

    public function allActors_countPlayRoles()
    {
        //LEFT JOIN to show ALL actors even if Count=0
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT DISTINCT a.*, COUNT(pr.actor_id) AS countRoles
            FROM actor a
            LEFT JOIN playroles pr ON pr.actor_id = a.id
            GROUP BY a.id
            ORDER BY a.firstname ASC, a.lastname ASC"
        );
    }

}