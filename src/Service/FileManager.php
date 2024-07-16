<?php
namespace App\Service;

use AllowDynamicProperties;
use App\Repository\AboutRepository;
use App\Repository\BlogRepository;
use App\Repository\PartnersRepository;
use App\Repository\PlayRepository;
use App\Repository\TeamRepository;

#[AllowDynamicProperties] class FileManager
{
    public function __construct()
    {
        $this->about = new AboutRepository();
        $this->play = new PlayRepository();
        $this->partners = new PartnersRepository();
        $this->team = new TeamRepository();
    }

    public static function updateEntityFile(string $entity, int $id, string $folderPath, ?string $filename, ?string $message): ?string
    {
        $oldFile = null;

        if (empty($message) && !empty($filename)) {
            switch ($entity) {
                case 'about':
                    $about = new AboutRepository();
                    $oldFile = $about->findOneById($id)->getImgPath();
                    $about->addImage($id, $filename);
                    break;
                case 'blog':
                    $blog = new BlogRepository();
                    $oldFile = $blog->findOneById($id)->getImgPath();
                    $blog->addImage($id, $filename);
                    break;
                case 'play':
                    $play = new PlayRepository();
                    $oldFile = $play->findOneById($id)->getImgPath();
                    $play->addImage($id, $filename);
                    break;
                case 'team':
                    $team = new TeamRepository();
                    $oldFile = $team->findOneById($id)->getImgPath();
                    $team->addImage($id, $filename);
                    break;
                case 'partners':
                    $partner = new PartnersRepository();
                    $oldFile = $partner->findOneById($id)->getImgPath();
                    $partner->addImage($id, $filename);
                    break;
                default :
                    break;
            }

            if (!empty($oldFile)) {
                if (file_exists($folderPath.$oldFile)) {
                    unlink($folderPath.$oldFile);
                }
            }
        }

        if (!empty($message)) {
            $message = "<br><br><span class='text-danger'><strong>Fichier téléchargé :</strong></span><br>" . $message;
        }

        return $message;
    }

    /**
     * Uploads file and executes self::updateEntityFile to unlink image on Update and adds new imgPath to $entity
     * Method self::updateEntityFile will return $message if any error occurs upon file upload
     * @param string $entity
     * @param int $id
     * @param string $folderPath
     * @return string|null
     */
    public static function uploadFile(string $entity, int $id, string $folderPath)
    {
        $message = null;
        $filename = null;

        if (!isset($_FILES)) {
            unset($_FILES);
            $message = "Une erreur s'est produite.<br>Veuillez réessayer plus tard !";
        }
        else {
            $uploadOk = 1;
            if (isset($_FILES["fileToUpload"])) {
                $tmpname = $_FILES["fileToUpload"]["tmp_name"];
                $name = $_FILES["fileToUpload"]["name"];
                $size = $_FILES["fileToUpload"]["size"];
                $error = $_FILES["fileToUpload"]["error"];
                unset($_FILES);

                if ($name != "" || $name != null) {
                    $tabExtension = explode(".",$name);
                    $originalFilename = str_replace(" ", "", $tabExtension[0]);
                    $extension = strtolower(end($tabExtension));
                    $extensionsAllowed = ["jpg", "png", "jpeg"];
                    $maxSize = 2097152; //2Mb

                    if(!in_array($extension, $extensionsAllowed)) {
                        $message = "Désolé, seuls les fichiers JPG/JPEG et PNG sont autorisés.";
                        $uploadOk = 0;
                    }

                    if ($size > $maxSize) {
                        $message = "La taille du fichier est trop grande (max: 2 Mo/2048 Ko).
                                    <br><br>
                                    Utiliser un compresseur d'images en ligne : <a class='' href='https://www.resizepixel.com/fr/' target='blanc'>cliquez ici</a>";
                        $uploadOk = 0;
                    }


                    if ($uploadOk == 1 && $error == 0) {
                        $uniqueName = uniqid($originalFilename . '_');
                        $filename = $uniqueName . "." . $extension;
                        $location = $folderPath.$filename;

                        if (!move_uploaded_file($tmpname, $location)) {
                            $message = "Désolé, une erreur s'est produite lors du téléchargement de votre fichier";
                        }
                    }
                }
            }
        }
        return self::updateEntityFile($entity, $id, $folderPath, $filename, $message);
    }
}

