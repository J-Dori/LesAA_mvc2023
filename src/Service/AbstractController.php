<?php
namespace App\Service;

abstract class AbstractController implements ControllerInterface
{
    protected function render($view, $data = null): array
    {
        return [
            "view" => $view, 
            "data" => $data
        ];
    }

    protected function isGranted($role): bool
    {
        return Session::isRoleUser($role);
    }

    protected function redirectTo($route): void
    {
        Router::redirect($route);
    }

    protected function addFlash($type, $message, $title = null)
    {
        Session::setMessage($type, $message, $title);
    }

    protected function logUser($user)
    {
        Session::setUser($user);
    }

    protected function logoutUser()
    {
        Session::removeUser();
    }
    
}