<?php
namespace App\Controller;

use AllowDynamicProperties;
use App\Repository\AboutRepository;
use App\Repository\BlogRepository;
use App\Repository\ContactRepository;
use App\Repository\HeadersRepository;
use App\Repository\PlayRepository;
use App\Repository\PartnersRepository;
use App\Repository\PlayRolesRepository;
use App\Repository\SocialMediaRepository;
use App\Repository\TeamRepository;
use App\Service\AbstractController;

#[AllowDynamicProperties] class HomeController extends AbstractController
{
    public function __construct()
    {
        $this->about = new AboutRepository();
        $this->blog = new BlogRepository();
        $this->contact = new ContactRepository();
        $this->headers = new HeadersRepository();
        $this->play = new PlayRepository();
        $this->playRoles = new PlayRolesRepository();
        $this->partners = new PartnersRepository();
        $this->team = new TeamRepository();
        $this->socialmedia = new SocialMediaRepository();
    }
    
    public function index(): array
    {
        return $this->render("home/home.php", [
            'headers' => $this->headers->findOneById(), //id=1 always - only one record
            'blockHighlight' => $this->play->getPlayActive(),
            'blockAbout' => $this->about->findAllActif(),
            'teamMembers' => $this->team->teamByRoleOrder(),
            'blockContact' => $this->contact->findActive(),
            'partners' => $this->partners->findAll(),
            'socialmedia' => $this->socialmedia->findOneById(), //id=1 always - only one record
        ]);
    }

    public function privacy(): array
    {
        return $this->render("home/privacy.php");
    }

    public function error404(): array
    {
        return $this->render("404.php");
    }

    public function playIndex(): array
    {
        return $this->render("home/play/index_play.php", [
            'pageTitle' => 'Nos Pièces',
            'plays' => $this->play->findAllYearDesc(),
            'socialmedia' => $this->socialmedia->findOneById(),
        ]);
    }

    public function play(int $id = null): array
    {
        return $this->render("home/play/view.php", [
            'play' => $this->play->findOneById($id),
            'playRoles' => $this->playRoles->playRoles_actor_ByPlayId($id),
            'contact' => $this->contact->findActive(),
            'socialmedia' => $this->socialmedia->findOneById(),
        ]);
    }

    public function blogIndex(): array
    {
        return $this->render("home/blog/index_blog.php", [
            'blog' => $this->blog->findAllActif('DESC'),
            'headers' => $this->headers->findOneById(), //id = 1 by default
            'pageTitle' => 'Actualités',
            'cssFile' => 'blog.css',
        ]);
    }

    public function article(int $id): array
    {
        return $this->render("home/blog/article.php", [
            'article' => $this->blog->findOneById($id),
            'pageTitle' => 'Article',
            'cssFile' => 'blog.css',
        ]);
    }

}