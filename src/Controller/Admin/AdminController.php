<?php
namespace App\Controller\Admin;

use AllowDynamicProperties;
use App\Repository\AboutRepository;
use App\Repository\ContactRepository;
use App\Repository\PartnersRepository;
use App\Repository\PlayRepository;
use App\Repository\SocialMediaRepository;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use App\Service\AbstractController;
use App\Service\Session;

#[AllowDynamicProperties] class AdminController extends AbstractController
{
    const ADMIN_VIEW = 'admin/home/';
    public function __construct()
    {
        $this->about = new AboutRepository();
        $this->play = new PlayRepository();
        $this->partners = new PartnersRepository();
        $this->team = new TeamRepository();
        $this->contact = new ContactRepository();
        $this->socialmedia = new SocialMediaRepository();
        $this->users = new UserRepository();
    }
    
    public function index(): array
    {
        return $this->render(self::ADMIN_VIEW . "home.php", [
            'blockHighlight' => $this->play->getPlayActive(),
            'blockContact' => $this->contact->findActive(),
        ]);
    }

    public function logout(): void
    {
        $name = Session::getUser() ? Session::getUser()->getFirstname() : "";
        $this->logoutUser();
        $this->addFlash("success", "Vous avez été déconnecté !<br>A bientôt <strong>$name</strong>...");
        $this->redirectTo('index.php');
    }

    public function privacy(): array
    {
        return $this->render("home/privacy.php");
    }

    public function error404(): array
    {
        return $this->render("404.php");
    }

}