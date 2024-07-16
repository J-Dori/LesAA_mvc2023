<?php
namespace App\Repository;

use App\Entity\SocialMedia;
use App\Service\AbstractManager;

class SocialMediaRepository extends AbstractManager
{
    const CLASS_NAME = SocialMedia::class;

    public function findOneById($id = null)
    {
        $id = 1;
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM socialmedia
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function getMedias(): array
    {
        $id = 1;
        $results = $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM socialmedia
             WHERE id = :id",
            [":id" => $id]
        );
        $array = [];
        foreach ($results as $name => $value) {
            $array[$name] = $value;
        }
        return $array;
    }

    public function findAll()
    {
        return;
    }

    public function updateData($facebook, $youtube, $instagram, $tiktok, $snapchat, $twitter)
    {
        $id = 1;
        return $this->executeQuery(
             "UPDATE socialmedia
             SET facebook = :facebook,
                 youtube = :youtube,
                 instagram = :instagram,
                 tiktok = :tiktok,
                 snapchat = :snapchat,
                 twitter = :twitter
             WHERE id = :id",
             [
                ":id" => $id,
                ":facebook" => $facebook,
                ":youtube" => $youtube,
                ":instagram" => $instagram,
                ":tiktok" => $tiktok,
                ":snapchat" => $snapchat,
                ":twitter" => $twitter
             ]
         );
    }
}
