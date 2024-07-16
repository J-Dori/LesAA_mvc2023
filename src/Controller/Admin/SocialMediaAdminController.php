<?php
namespace App\Controller\Admin;

use AllowDynamicProperties;
use App\Repository\SocialMediaRepository;
use App\Service\AbstractController;
use App\Service\Session;

#[AllowDynamicProperties] class SocialMediaAdminController extends AbstractController
{
    const CTRL_VIEW = 'admin/contact/socialMedia/';
    public function __construct()
    {
        $this->socialMedia = new SocialMediaRepository();
    }

    public function index(): array
    {
        Session::removeIfNotAdmin();

        $facebook = null;
        $youtube = null;
        $instagram = null;
        $tiktok = null;
        $snapchat = null;
        $twitter = null;

        if (empty($_POST) && $socialMedia = $this->socialMedia->findOneById()) {
            $facebook = $socialMedia->getFacebook() ? $socialMedia->getFacebook() : null;
            $youtube = $socialMedia->getYoutube() ? $socialMedia->getYoutube() : null;
            $instagram = $socialMedia->getInstagram() ? $socialMedia->getInstagram() : null;
            $tiktok = $socialMedia->getTiktok() ? $socialMedia->getTiktok() : null;
            $snapchat = $socialMedia->getSnapchat() ? $socialMedia->getSnapchat() : null;
            $twitter = $socialMedia->getTwitter() ? $socialMedia->getTwitter() : null;
        }

        if(!empty($_POST))
        {
            $facebook = filter_input(INPUT_POST, 'facebook', FILTER_SANITIZE_URL);;
            $youtube = filter_input(INPUT_POST, 'youtube', FILTER_SANITIZE_URL);;
            $instagram = filter_input(INPUT_POST, 'instagram', FILTER_SANITIZE_URL);;
            $tiktok = filter_input(INPUT_POST, 'tiktok', FILTER_SANITIZE_URL);;
            $snapchat = filter_input(INPUT_POST, 'snapchat', FILTER_SANITIZE_URL);;
            $twitter = filter_input(INPUT_POST, 'twitter', FILTER_SANITIZE_URL);;

            try {
                $this->socialMedia->updateData($facebook, $youtube, $instagram, $tiktok, $snapchat, $twitter);
                $this->addFlash("success",  "Données modifiées !");
            } catch (\Exception $e) {
                $this->addFlash("danger",  "Une erreur est survenue !<br>Vérifiez si les champs sont bien remplis.<br>" . $e );
            }

            $this->redirectTo('?ctrl=socialMediaAdmin&action=index');
        }

        return $this->render(self::CTRL_VIEW . "index_form.php", [
            'facebook' => $facebook,
            'youtube' => $youtube,
            'instagram' => $instagram,
            'tiktok' => $tiktok,
            'snapchat' => $snapchat,
            'twitter' => $twitter,
            'pageTitle' => 'Modifier Réseaux Sociaux',
        ]);
    }

}