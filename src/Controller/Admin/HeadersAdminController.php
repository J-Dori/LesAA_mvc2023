<?php
namespace App\Controller\Admin;

use AllowDynamicProperties;
use App\Repository\HeadersRepository;
use App\Service\AbstractController;
use App\Service\Session;

#[AllowDynamicProperties] class HeadersAdminController extends AbstractController
{
    const CTRL_VIEW = 'admin/headers/';
    public function __construct()
    {
        $this->headers = new HeadersRepository();
    }

    public function index(): array
    {
        Session::removeIfNotAdmin();

        $bannerTitle = null;
        $bannerSubtitle = null;
        $headlightTitle = null;
        $headlightSubtitle = null;
        $aboutSubtitle = null;
        $aboutFooter = null;
        $teamSubtitle = null;
        $blogSubtitle = null;
        $partnersSubtitle = null;

        if (empty($_POST) && $headers = $this->headers->findOneById()) {

            $bannerTitle = $headers->getBannerTitle() ? $headers->getBannerTitle() : null;
            $bannerSubtitle = $headers->getBannerSubtitle() ? $headers->getBannerSubtitle() : null;
            $headlightTitle = $headers->getHeadlightTitle() ? $headers->getHeadlightTitle() : null;
            $headlightSubtitle = $headers->getHeadlightSubtitle() ? $headers->getHeadlightSubtitle() : null;
            $aboutSubtitle = $headers->getAboutSubtitle() ? $headers->getAboutSubtitle() : null;
            $aboutFooter = $headers->getAboutFooter() ? $headers->getAboutFooter() : null;
            $teamSubtitle = $headers->getTeamSubtitle() ? $headers->getTeamSubtitle() : null;
            $blogSubtitle = $headers->getBlogSubtitle() ? $headers->getBlogSubtitle() : null;
            $partnersSubtitle = $headers->getPartnersSubtitle() ? $headers->getPartnersSubtitle() : null;
        }

        if(!empty($_POST))
        {
            $bannerTitle = htmlspecialchars_decode(filter_input(INPUT_POST, 'bannerTitle'));
            $bannerSubtitle = htmlspecialchars_decode(filter_input(INPUT_POST, 'bannerSubtitle'));
            $headlightTitle = htmlspecialchars_decode(filter_input(INPUT_POST, 'headlightTitle'));
            $headlightSubtitle = htmlspecialchars_decode(filter_input(INPUT_POST, 'headlightSubtitle'));
            $aboutSubtitle = htmlspecialchars_decode(filter_input(INPUT_POST, 'aboutSubtitle'));
            $aboutFooter = htmlspecialchars_decode(filter_input(INPUT_POST, 'aboutFooter'));
            $teamSubtitle = htmlspecialchars_decode(filter_input(INPUT_POST, 'teamSubtitle'));
            $blogSubtitle = htmlspecialchars_decode(filter_input(INPUT_POST, 'blogSubtitle'));
            $partnersSubtitle = htmlspecialchars_decode(filter_input(INPUT_POST, 'partnersSubtitle'));

            if ($this->headers->updateData(
                $bannerTitle, $bannerSubtitle,
                $headlightTitle, $headlightSubtitle,
                $aboutSubtitle, $aboutFooter, $teamSubtitle,
                $blogSubtitle, $partnersSubtitle
            )) {
                $this->addFlash("success",  "Données modifiées !");
            } else {
                $this->addFlash("danger",  "Une erreur est survenue !<br>Vérifiez si les champs sont bien remplis.");
            }

            $this->redirectTo('?ctrl=headersAdmin&action=index');
        }

        return $this->render(self::CTRL_VIEW . "index_form.php", [
            'bannerTitle' => $bannerTitle ?: null,
            'bannerSubtitle' => $bannerSubtitle ?: null,
            'headlightTitle' => $headlightTitle ?: null,
            'headlightSubtitle' => $headlightSubtitle ?: null,
            'aboutSubtitle' => $aboutSubtitle ?: null,
            'aboutFooter' => $aboutFooter ?: null,
            'teamSubtitle' => $teamSubtitle ?: null,
            'blogSubtitle' => $blogSubtitle ?: null,
            'partnersSubtitle' => $partnersSubtitle ?: null,
            'pageTitle' => 'En-tête des bloques',
        ]);
    }

}