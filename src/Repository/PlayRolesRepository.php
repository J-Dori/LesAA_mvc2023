<?php
namespace App\Repository;

use App\Entity\PlayRoles;
use App\Service\AbstractManager;

class PlayRolesRepository extends AbstractManager
{
    const CLASS_NAME = PlayRoles::class;

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM playroles
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findAll(): array
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *, play_id as playID
             FROM playroles
             ORDER BY play_id DESC"
        );
    }

    public function addRecord($play, $actor, $role = null)
    {
        $this->executeQuery(
            "INSERT INTO playroles (play_id, actor_id, roleName)
            VALUES (:play_id, :actor_id, :role)",
            [
                ":play_id" => $play,
                ":actor_id" => $actor,
                ":role" => $role,
            ]
        );
    }

    public function updateData($id, $play, $actor, $role = null) {
        return $this->executeQuery(
            "UPDATE playroles
             SET play_id = :play,
                 actor_id = :actor,
                 roleName = :role,
                 phone = :phone
             WHERE id = :id",
            [
                ":id" => $id,
                ":play_id" => $play,
                ":actor_id" => $actor,
                ":role" => $role,
            ]
        );
    }

    public function deleteRecord($id)
    {
        $this->executeQuery(
            "DELETE FROM playroles 
            WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }

    public function playRoles_actor_ByPlayId($play)
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
                FROM playroles pr
                WHERE pr.play_id = :id",
            [":id" => $play]
        );
    }

    /**
     * PlayRoles Index : display a table for each Play
     * @return array|null
     */
    public function arrayAllRolesByPlayDesc(): ?array
    {
        $array = [];
        $results = $this->fetchAssociation("SELECT playroles.*, actor.*, playroles.id AS playRoleID
             FROM playroles
             INNER JOIN actor ON playroles.actor_id = actor.id
             ORDER BY play_id DESC, roleName ASC");

        foreach (json_decode($results, JSON_OBJECT_AS_ARRAY) as $result) {
            $array[$result['play_id']][] = ['id' => $result['playRoleID'], 'role' => $result['roleName'], 'actor' => $result['firstname'] . ' ' . $result['lastname']];
        }
        return $array;
    }

    public function playRoles_ByActor($actor)
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *, p.id AS playID
                FROM playroles pr
                INNER JOIN play p ON pr.play_id = p.id
                WHERE pr.actor_id = :id",
            [":id" => $actor]
        );
    }

    


}