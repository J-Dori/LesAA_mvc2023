<?php
namespace App\Repository;

use App\Entity\Play;
use App\Service\AbstractManager;

class PlayRepository extends AbstractManager
{
    const CLASS_NAME = Play::class;

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM play
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findAll(): array
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM play
             ORDER BY year ASC, title ASC"
        );
    }
  
  public function findAllYearDesc(): array
  {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM play
             ORDER BY year DESC, title ASC"
        );
    }

    public function findAll_NoDescription(): array
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT id, title, year, imgPath, active
             FROM play
             ORDER BY year ASC, title ASC"
        );
    }

    public function addRecord($title, $year, $description, $videoPath, $activeText, $dateStart, $dateEnd, $active = 0)
    {
        $active = !empty($active) ? 1 : 0;

        $this->executeQuery(
            "INSERT INTO play (title, year, description, videoPath, activeText, dateStart, dateEnd, active)
            VALUES (:title, :year, :description, :videoPath, :activeText, :dateStart, :dateEnd, :active)",
            [
                ":title" => $title,
                ":year" => $year,
                ":description" => $description,
                ":videoPath" => $videoPath,
                ":activeText" => $activeText,
                ":dateStart" => $dateStart,
                ":dateEnd" => $dateEnd,
                ":active" => (int)$active,
            ]
        );

        self::setActive(self::$pdo->lastInsertId(), $active);

        return self::$pdo->lastInsertId();
    }

    public function updateData($id, $title, $year, $description, $videoPath, $activeText, $dateStart, $dateEnd, $active = 0)
    {
        $active = !empty($active) ? 1 : 0;

        $this->executeQuery(
             "UPDATE play
             SET title = :title,
                 year = :year,
                 description = :description,
                 videoPath = :videoPath,
                 activeText = :activeText,
                 dateStart = :dateStart,
                 dateEnd = :dateEnd
                 
             WHERE id = :id",
             [
                 ":id" => $id,
                 ":title" => $title,
                 ":year" => $year,
                 ":description" => $description,
                 ":videoPath" => $videoPath,
                 ":activeText" => $activeText,
                 ":dateStart" => $dateStart,
                 ":dateEnd" => $dateEnd,
             ]
        );

        self::setActive($id, $active);
    }

    public function setActive(int $id, int|bool $active)
    {
        if ($active == 1) {
            //If user sets a new Play Active, this will set first ALL plays active=0 to assure that there aren't more than 1 play set as True(1)
            $this->executeQuery(
                "UPDATE play
                 SET active = 0",
                 []
            );
        }
        $this->executeQuery(
            "UPDATE play
             SET active = :active
            WHERE id = :id",
            [
                ":id" => $id,
                ":active" => $active
            ]
        );
    }

    public function getPlayActive()
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
            FROM play
            WHERE active = 1"
        );
    }

    public function deleteRecord(int $id)
    {
        $this->executeQuery(
            "DELETE FROM play
            WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }

    public function addImage(int $id, string $newFile)
    {
        $this->executeQuery(
            "UPDATE play
            SET
                imgPath = :newFile
            WHERE id = :id",
            [
                ":id" => $id,
                ":newFile" => $newFile,
            ]
        );
    }

    public function removeImage(int $id)
    {
        $this->executeQuery(
            "UPDATE play
            SET
                imgPath = null
            WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }

    public function playRolesByPlayId(int $id)
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
                FROM actor a
                INNER JOIN playroles pr ON pr.actor_id = a.id
                WHERE pr.play_id = :id
                ORDER BY a.firstname ASC, a.lastname ASC",
            [":id" => $id]
        );
    }
}
