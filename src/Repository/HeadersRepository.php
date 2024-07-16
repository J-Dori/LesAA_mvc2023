<?php
namespace App\Repository;

use App\Entity\Headers;
use App\Service\AbstractManager;

class HeadersRepository extends AbstractManager
{
    const CLASS_NAME = Headers::class;

    public function findOneById($id = null)
    {
        $id = 1;
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM headers
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function getArrayHeaders(): array
    {
        $results = self::findOneById();
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

    public function updateData(
        $bannerTitle = null, $bannerSubtitle = null,
        $headlightTitle = null, $headlightSubtitle = null,
        $aboutSubtitle = null, $aboutFooter = null, $teamSubtitle = null,
        $blogSubtitle = null, $partnersSubtitle = null
    )
    {
        $id = 1;
        return $this->executeQuery(
             "UPDATE headers
             SET bannerTitle = :bannerTitle,
                 bannerSubtitle = :bannerSubtitle,
                 headlightTitle = :headlightTitle,
                 headlightSubtitle = :headlightSubtitle,
                 aboutSubtitle = :aboutSubtitle,
                 aboutFooter = :aboutFooter,
                 teamSubtitle = :teamSubtitle,
                 blogSubtitle = :blogSubtitle,
                 partnersSubtitle = :partnersSubtitle
             WHERE id = :id",
             [
                ":id" => $id,
                ":bannerTitle" => $bannerTitle,
                ":bannerSubtitle" => $bannerSubtitle,
                ":headlightTitle" => $headlightTitle,
                ":headlightSubtitle" => $headlightSubtitle,
                ":aboutSubtitle" => $aboutSubtitle,
                ":aboutFooter" => $aboutFooter,
                ":teamSubtitle" => $teamSubtitle,
                ":blogSubtitle" => $blogSubtitle,
                ":partnersSubtitle" => $partnersSubtitle
             ]
         );
    }
}
