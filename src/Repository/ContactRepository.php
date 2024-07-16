<?php
namespace App\Repository;

use App\Entity\Contact;
use App\Service\AbstractManager;

class ContactRepository extends AbstractManager
{
    const CLASS_NAME = Contact::class;

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM contact
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findAll(): ?array
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM contact
             ORDER BY active DESC, responsableName ASC",
        );
    }

    public function findActive()
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM contact
             WHERE active = true",
        );
    }

    public function getActiveTheaterAddressUrl()
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT theaterAddress
             FROM contact
             WHERE active = true",
        );
    }

    public function getActiveOnlineBookingUrl()
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT onlineBooking
             FROM contact
             WHERE active = true",
        );
    }

    public function addRecord(
        $responsableName, $postAddress, $postPhone,
        $email,
        $theaterName, $theaterAddress, $theaterMapLink, $onlineBooking
    )
    {
        $this->executeQuery(
            "INSERT INTO contact (responsableName, postAddress, postPhone, email, theaterName, theaterAddress, theaterMapLink, onlineBooking, active)
                 VALUES (:responsableName, :postAddress, :postPhone, :email, :theaterName, :theaterAddress, :theaterMapLink, :onlineBooking, false)",
            [
                ":responsableName" => $responsableName,
                ":postAddress" => $postAddress,
                ":postPhone" => $postPhone,
                ":email" => $email,
                ":theaterName" => $theaterName,
                ":theaterAddress" => $theaterAddress,
                ":theaterMapLink" => $theaterMapLink,
                ":onlineBooking" => $onlineBooking,
            ]
        );

        return self::$pdo->lastInsertId();
    }

    public function updateData(
        $id,
        $responsableName, $postAddress, $postPhone,
        $email,
        $theaterName, $theaterAddress, $theaterMapLink, $onlineBooking
    )
    {
        $this->executeQuery(
             "UPDATE contact
             SET responsableName = :responsableName,
                 postAddress = :postAddress,
                 postPhone = :postPhone,
                 email = :email,
                 theaterName = :theaterName,
                 theaterAddress = :theaterAddress,
                 theaterMapLink = :theaterMapLink,
                 onlineBooking = :onlineBooking
             WHERE id = :id",
             [
                ":id" => $id,
                ":responsableName" => $responsableName,
                ":postAddress" => $postAddress,
                ":postPhone" => $postPhone,
                ":email" => $email,
                ":theaterName" => $theaterName,
                ":theaterAddress" => $theaterAddress,
                ":theaterMapLink" => $theaterMapLink,
                ":onlineBooking" => $onlineBooking,
             ]
         );
    }

    public function setActive($id, $active)
    {
        if ($active == 1) {
            //If user sets a Contact Active, this will set first ALL contacts active=0 to assure that there aren't more than 1 contact set as True(1)
            $this->executeQuery(
                "UPDATE contact
                 SET active = 0",
                []
            );
        }
        $this->executeQuery(
            "UPDATE contact
             SET active = :active
            WHERE id = :id",
            [
                ":id" => $id,
                ":active" => $active
            ]
        );
    }

    public function deleteRecord($id)
    {
        $this->executeQuery(
            "DELETE FROM contact
            WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }
}
