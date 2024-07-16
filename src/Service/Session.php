<?php
namespace App\Service;

class Session
{
    public static function setUser($user): void
    {
        $_SESSION["user"] = $user;
    }

    public static function getUser()
    {
        return $_SESSION["user"] ?? null;
    }

    public static function isAdmin(): bool
    {
        if(self::getUser()) {
            if(self::getUser()->getRole() == ROLE_ADMIN)
            {
                return true;
            }
        }
        return false;
    }

    public static function isAccount(): bool
    {
        if(self::getUser()) {
            if(self::getUser()->getRole() == ROLE_ACCOUNT)
            {
                return true;
            }
        }
        return false;
    }

    public static function removeIfNotAdmin(): void
    {
        if (!self::isAdmin()) {
            self::removeUser();
        }
    }

    public static function removeIfNotAdminOrAccount(): void
    {
        if (!self::isAdmin() && !self::isAccount()) {
            self::removeUser();
        }
    }

    public static function removeUser(): void
    {
        unset($_SESSION["user"]);
        header('Location: https://lesagitacteurs.fr', true, 403);
        exit();
    }

    public static function isRoleUser($role): bool
    {
        if(!self::getUser())
        {
            return false;
        } elseif (self::getUser()->getRole() !== $role)
        {
            return false;
        }
        return true;
    }

    public static function isAnonymous(): bool
    {
        if(self::getUser())
        {
            return false;
        }
        return true;
    }

    public static function getMessages($type): array
    {
        if(isset($_SESSION["messages"]) && isset($_SESSION["messages"][$type]))
        {
            $messages = $_SESSION["messages"][$type];
            unset($_SESSION["messages"][$type]);
            return $messages;
        }
        return [];
    }

    public static function setMessage(string $type, string $msg, string $title = null) :void
    {
        unset($_SESSION["messages"]);
        $_SESSION['messages'] = [
            "type" => $type,
            "msg" => $msg,
            "title" => $title,
        ];
    }
}