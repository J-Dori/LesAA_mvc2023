<?php
namespace App\Controller\Admin;

use AllowDynamicProperties;
use App\Repository\ContactRepository;
use App\Service\AbstractController;
use App\Service\Session;

#[AllowDynamicProperties] class ContactAdminController extends AbstractController
{
    const CTRL_VIEW = 'admin/contact/';
    public function __construct()
    {
        $this->contact = new ContactRepository();
    }

    public function index(): array
    {
        Session::removeIfNotAdmin();

        return $this->render(self::CTRL_VIEW . "index.php", [
            'contacts' => $this->contact->findAll(),
            'pageTitle' => 'Contacts',
        ]);
    }

    public function setActive(int $id): array
    {
        Session::removeIfNotAdmin();

        if (!empty($this->contact->findOneById($id))) {
            $this->contact->setActive($id, true);
            $this->addFlash("success",  "Nouveau contact mis en évidence !");
        }

        return self::index();
    }

    public function delete(int $id): void
    {
        Session::removeIfNotAdmin();

        if ($this->contact->findOneById($id)) {
            try {
                $this->contact->deleteRecord($id);
                $this->addFlash('success', 'Element supprimé avec success.', 'Suppression');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'Une erreur est survenue. Contactez le WebMaster.', 'Suppression');
            }
        }

        $this->redirectTo('?ctrl=contactAdmin&action=index');
    }

    public function formContact(int $id = null): array
    {
        Session::removeIfNotAdmin();

        $editMode = null;

        $responsableName = null;
        $postAddress = null;
        $postPhone = null;
        $email = null;
        $theaterName = null;
        $theaterAddress = null;
        $theaterMapLink = null;
        $onlineBooking = null;
        //$active = null;

        if ($id && empty($_POST) && $contact = $this->contact->findOneById($id)) {
            $editMode = '&id='.$id;

            $responsableName = $contact->getResponsableName() ? $contact->getResponsableName() : null;
            $postAddress = $contact->getPostAddress() ? $contact->getPostAddress() : null;
            $postPhone = $contact->getPostPhone() ? $contact->getPostPhone() : null;
            $email = $contact->getEmail() ? $contact->getEmail() : null;
            $theaterName = $contact->getTheaterName() ? $contact->getTheaterName() : null;
            $theaterAddress = $contact->getTheaterAddress() ? $contact->getTheaterAddress() : null;
            $theaterMapLink = $contact->getTheaterMapLink() ? $contact->getTheaterMapLink() : null;
            $onlineBooking = $contact->getOnlineBooking() ? $contact->getOnlineBooking() : null;
            //$active = $contact->isActive();
        }

        if(!empty($_POST))
        {
            $responsableName = htmlspecialchars(filter_input(INPUT_POST, 'responsableName'));
            $postAddress = htmlspecialchars_decode(filter_input(INPUT_POST, 'postAddress'));
            $postPhone = htmlspecialchars(filter_input(INPUT_POST, 'postPhone'));
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $theaterName = htmlspecialchars(filter_input(INPUT_POST, 'theaterName'));
            $theaterAddress = htmlspecialchars_decode(filter_input(INPUT_POST, 'theaterAddress'));
            $theaterMapLink = filter_input(INPUT_POST, 'theaterMapLink', FILTER_SANITIZE_URL);
            $onlineBooking = filter_input(INPUT_POST, 'onlineBooking', FILTER_SANITIZE_URL);
            //$active = false;

            try {
                if (empty($id)) {
                    if (!empty($responsableName)) {
                        if ($this->contact->addRecord(
                            $responsableName, $postAddress, $postPhone, $email,
                            $theaterName, $theaterAddress, $theaterMapLink, $onlineBooking
                        )) {
                            $this->addFlash("success", "Données enregistrées !");
                        }
                    } else {
                        $this->addFlash("danger",  "Le champ « Contact : NOM » est obligatoire." );
                    }

                } else {
                    $this->contact->updateData($id,
                        $responsableName, $postAddress, $postPhone, $email,
                        $theaterName, $theaterAddress, $theaterMapLink, $onlineBooking);
                    $this->addFlash("success",  "Données modifiées !");

                }
            } catch (\Exception $e) {
                $this->addFlash("danger",  "Une erreur est survenue !<br>Vérifiez si les champs sont bien remplis.<br>" . $e );
            }

            $this->redirectTo('?ctrl=contactAdmin&action=index');
        }

        return $this->render(self::CTRL_VIEW . "contact_form.php", [
            'responsableName' => $responsableName,
            'postAddress' => $postAddress,
            'postPhone' => $postPhone,
            'email' => $email,
            'theaterName' => $theaterName,
            'theaterAddress' => $theaterAddress,
            'theaterMapLink' => $theaterMapLink,
            'onlineBooking' => $onlineBooking,
            'editMode' => $editMode,
            'pageTitle' => $id ? 'Modifier Contact' : 'Nouveau Contact',
        ]);
    }

}