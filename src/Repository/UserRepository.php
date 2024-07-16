<?php
namespace App\Repository;

use App\Entity\User;
use App\Service\AbstractManager;

class UserRepository extends AbstractManager
{
    const CLASS_NAME = User::class;
    const ALL_FIELDS = "id, firstname, lastname, phone, role, email";

    public function findAll()
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT ". self::ALL_FIELDS ." 
             FROM user
             ORDER BY firstname ASC, lastname ASC"
        );
    }

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT ". self::ALL_FIELDS ." FROM user
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findUserByEmail($email)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT ". self::ALL_FIELDS ." FROM user WHERE email = :email",
            [":email" => mb_strtolower($email)]
        );
    }

    public function findPasswordByEmail($email)
    {
        return $this->getOneOrNullValue(
            "SELECT password FROM user WHERE email = :email",
            [":email" => mb_strtolower($email)]
        );
    }

    public function verifyUser($email)
    {
        $email = strtolower($email);

        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT ". self::ALL_FIELDS ." FROM user WHERE LOWER(email) = :email",
            [":email" => $email]
        );
    }

    public function insertUser($firstname, $lastname, $phone, $role, $email, $password)
    {
        return $this->executeQuery(
            "INSERT INTO user (firstname, lastname, phone, role, email, password)
             VALUES (:firstname, :lastname, :phone, :role, :email, :password)",
            [
                ":firstname" => ucfirst($firstname),
                ":lastname" => mb_strtoupper($lastname),
                ":phone" => $phone,
                ":role" => mb_strtoupper($role),
                ":email" => mb_strtolower($email),
                ":password" => $password
            ]
        );
    }

    public function updateUser($id, $firstname, $lastname, $phone, $role, $email) {
       return $this->executeQuery(
            "UPDATE user 
            SET firstname = :firstname,
                lastname = :lastname,
                phone = :phone,
                role = :role,
                email = :email
            WHERE id = :id",
            [
                ":id" => $id,
                ":firstname" => ucfirst($firstname),
                ":lastname" => mb_strtoupper($lastname),
                ":phone" => $phone,
                ":role" => mb_strtoupper($role),
                ":email" => mb_strtolower($email),
            ]
        );
    }

    public function updatePassword($email, $hash) {
       return $this->executeQuery(
            "UPDATE user SET password = :hash
            WHERE email = :email",
            [
                ":email" => mb_strtolower($email), 
                ":hash" => $hash
            ]
        );
    }

    public function updateAvatarImg($id, $updFile)
    {
        return $this->executeQuery(
            "UPDATE user SET avatar = :updFile WHERE id = :id",
            [
                ":id" => $id, 
                ":updFile" => $updFile
            ]
        );
    }

    public function deleteUser($id)
    {
        return $this->executeQuery(
            "DELETE FROM user WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }

}